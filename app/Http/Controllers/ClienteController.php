<?php

namespace App\Http\Controllers;

use App\Cliente;
use App\ClienteFormaConhecimento;
use App\ClienteTipo;
use App\Estado;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Validator;
use function redirect;
use function response;
use function view;

class ClienteController extends Controller
{
    private $cliente;
    private $usuario;
    private $permissao = [];
    
    public function __construct(Cliente $cliente)
    {
        $this->middleware('auth');
        $this->cliente = $cliente;
        view()->share('menu', 'clientes');
        
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        // obtendo a listagem de clientes
        $clientes = $this->cliente->listar();
        
        // configurando o titulo e os breadcrumbs
        $titulo = 'Clientes';
        $breadcrumb = [['nome' => 'Listagem de Clientes', 'ultimo' => true]];

        // enviando dados para a view
        return view('cliente.index')
                ->with('clientes', $clientes)
                ->with('paginaTitulo', $titulo)
                ->with('paginaBreadcrumb', $breadcrumb);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        // obtendo os tipos de clientes
        $tiposCliente = ClienteTipo::where('ativo', 1)->get();
        
        // obtendo as formas de conhecimentos
        $formasConhecimento = ClienteFormaConhecimento::where('ativo', 1)->get();
        
        // obtendo os estados
        $estados = Estado::all();
        
        // configurando o titulo e os breadcrumbs
        $titulo = 'Cadastro';
        $breadcrumb = [
                        ['nome' => 'Cliente', 'ultimo' => false],
                        ['nome' => 'Novo Cliente', 'ultimo' => true],
            ];
        
        // enviando dados para a view
        return view('cliente.form')
                ->with('cliente', new Cliente()) // enviando um obj vazio
                ->with('tiposCliente', $tiposCliente)
                ->with('formasConhecimento', $formasConhecimento)
                ->with('estados', $estados)
                ->with('paginaTitulo', $titulo)
                ->with('paginaBreadcrumb', $breadcrumb);
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        // buscanso os dados do cliente
        $cliente = Cliente::findOrNew($id);
        
        // caso não encontre o cliente, redireciona para o form de adição
        if (empty($cliente->id)) {
            return redirect('clientes')
                    ->with('flash_message', 'Cliente não encontrado!')
                    ->with('flash_type', 'warning');
        }
        
        // tratando a data de nascimento
        $cliente->data_nascimento = $this->tratarData($cliente->data_nascimento, 2);

        // obtendo os tipos de clientes
        $tiposCliente = ClienteTipo::where('ativo', 1)->get();
        
        // obtendo as formas de conhecimentos
        $formasConhecimento = ClienteFormaConhecimento::where('ativo', 1)->get();
        
        // obtendo os estados
        $estados = Estado::all();
        
        // configurando o titulo e os breadcrumbs
        $titulo = 'Edição';
        $breadcrumb = [
                        ['nome' => 'Cliente', 'ultimo' => false],
                        ['nome' => 'Editar Cliente', 'ultimo' => true],
            ];
        
        // enviando dados para a view
        return view('cliente.form')
                ->with('cliente', $cliente)
                ->with('tiposCliente', $tiposCliente)
                ->with('formasConhecimento', $formasConhecimento)
                ->with('estados', $estados)
                ->with('paginaTitulo', $titulo)
                ->with('paginaBreadcrumb', $breadcrumb);
    }
    
    public function rules($tipo)
    {
        // regras para pessoa física
        if ($tipo == 4) {
            
            $regras_variaveis = [
                'nome_pf' => 'required',
//                'cpf_pf' => 'required|min:14|cpf',
                'telefone_pf' => 'required',
            ];
            
        // regras para pessoa jurídica
        } else {
            $regras_variaveis = [
                'nome_pj' => 'required',
//                'cnpj' => 'required|cnpj',
                'responsavel' => 'required',
//                'cpf_pj' => 'required|min:14|cpf',
                'telefone_pj' => 'required',
            ];
        }
        
        $regras = [
            'cep' => 'required|min:9',
            'endereco' => 'required',
            'numero' => 'required',
            'bairro' => 'required',
            'estado' => 'required|not_in:-1',
            'cidade' => 'required|not_in:-1',
        ];
        
        return array_merge($regras, $regras_variaveis);
    }

    public function messages()
    {
        $campo_obrigatorio = '* Esse campo é <strong>obrigatório.</strong>';
        
        return [
            'nome_pf.required' => $campo_obrigatorio,
            'cpf_pf.required' => $campo_obrigatorio,
            'telefone_pf.required' => $campo_obrigatorio,
            'nome_pj.required' => $campo_obrigatorio,
            'cnpj.required' => $campo_obrigatorio,
            'responsavel.required' => $campo_obrigatorio,
            'cpf_pj.required' => $campo_obrigatorio,
            'telefone_pj.required' => $campo_obrigatorio,
            'cep.required' => $campo_obrigatorio,
            'endereco.required' => $campo_obrigatorio,
            'numero.required' => $campo_obrigatorio,
            'bairro.required' => $campo_obrigatorio,
            'estado.required' => $campo_obrigatorio,
            'cidade.required' => $campo_obrigatorio,
            'estado.not_in' => $campo_obrigatorio,
            'cidade.not_in' => $campo_obrigatorio,
            'cpf_pf.cpf' => 'Informe um CPF válido.',
            'cpf_pj.cpf' => 'Informe um CPF válido.',
            'cnpj' => 'Informe um CNPJ válido.',
            'cep.min' => 'O CEP precisa ter 9 caracteres.',
        ];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        // obtendo o tipo de cliente
        $tipo = $request->get('cliente_tipo');
        
        // aplicando as validações
        $validator = Validator::make(
                $request->all(), 
                $this->rules($tipo), 
                $this->messages()
            );
        
        // direcionando caso aconteça algum erro
        if ($validator->fails()) {
            return redirect('cliente/novo')->withErrors($validator)->withInput();
        }
        
        // salvando o cliente
        $retorno = $this->save($request);
        
        // tratamento para salvo com sucesso
        if ($retorno) {
            $tipo = 'success';
            $tratamento = (empty($request->get('id'))) ? 'cadastrado' : 'alterado';
            $mensagem = 'Cliente '.$tratamento.' com sucesso!';
            
            switch ($request->get('envio')) {
                case 'salvarEFechar' : $redirect = 'clientes'; break;
                case 'salvar' : $redirect = 'cliente/editar/'.$retorno; break;
                case 'salvarAbrirPedido' : $redirect = 'atendimento/orcamento/novo/'.$retorno; break;
            }
        
        } else {
            // redireciona caso erro
            return redirect('cliente/novo')->withErrors($validator)->withInput();
        }
        
        // mensagens flash
        $request->session()->flash('flash_message', $mensagem);
        $request->session()->flash('flash_type', $tipo);

        // retorno
        return redirect($redirect);
    }
    
    public function save(Request $request)
    {
        // obtendo o tipo de cliente
        $tipo = $request->get('cliente_tipo');
        
        // tratamento de campos para pessoa física e jurídica
        $final = ($tipo == 4) ? '_pf' : '_pj';
        
        // buscando o objeto cliente (edição) ou criando um novo (inclusão)
        $id = $request->get('id');
        $cliente = Cliente::findOrNew($id);
        
        // setando os campos comuns e tratados
        $cliente->tipo = $tipo;
        $cliente->nome = $request->get('nome' . $final);
        $cliente->email = $request->get('email' . $final);
        $cliente->telefone = $request->get('telefone' . $final);
        $cliente->celular = $request->get('celular' . $final);
        $cliente->forma_conhecimento = ($request->get('forma_conhecimento' . $final)) ?: null;
        $cliente->cpf = $request->get('cpf' . $final);
        $cliente->cep = $request->get('cep');
        $cliente->endereco = $request->get('endereco');
        $cliente->bairro = $request->get('bairro');
        $cliente->numero = $request->get('numero');
        $cliente->complemento = $request->get('complemento');
        $cliente->estado = $request->get('estado');
        $cliente->cidade = $request->get('cidade');
        
        // setando campos somente pessoa física
        if ($tipo == 4) {
            $cliente->rg = $request->get('rg');
            $cliente->data_nascimento = $this->tratarData($request->get('data_nascimento'));
        // setando campos somente pessoa jurídica
        } else {
            $cliente->cnpj = $request->get('cnpj');
            $cliente->inscricao_estadual = $request->get('inscricao_estadual');
            $cliente->inscricao_municipal = $request->get('inscricao_municipal');
            $cliente->isento_inscricao_estadual = $request->get('isento_inscricao', 0);
            $cliente->responsavel = $request->get('responsavel');
            $cliente->cargo = $request->get('cargo');
        }
        
        // salvando o registro
        $retorno = (empty($id)) ? $cliente->save() : $cliente->update();
        
        // envio o id do cliente, caso tenha ocorrido tudo certo
        return ($retorno) ? $cliente->id : false;
    }
    
    public function tratarData($data, $tipo = 1)
    {
        if ($data) {
            if ($tipo == 1) {
                $array_data = explode('/', $data);
                $retorno = $array_data[2].'-'.$array_data[1].'-'.$array_data[0];
            } else if ($tipo == 2) {
                $array_data = explode('-', $data);
                $retorno = $array_data[2].'/'.$array_data[1].'/'.$array_data[0];
            } else {
                $retorno = null;
            }
        } else {
            $retorno = null;
        }
        
        return $retorno;
    }

    /**
     * Remove the specified resource from storage.
     * TODO verificar se o cliente possui orçamento
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        // buscando o cliente
        $cliente = Cliente::findOrNew($id);
        
        // caso não encontre o cliente redireciona para a tela de clientes
        if (empty($cliente->id)) {
            return redirect('clientes')
                    ->with('flash_message', 'Cliente não encontrado!')
                    ->with('flash_type', 'warning');
        }
        
        // deletando o cliente
        if ($cliente->delete()) {
            $mensagem = 'Cliente excluído com sucesso!';
            $tipo = 'success';
        } else {
            $mensagem = 'Ocorreu um erro ao tentar excluir o cliente.';
            $tipo = 'error';
        }
        
        // retornando com as mensagens
        return redirect('clientes')
                    ->with('flash_message', $mensagem)
                    ->with('flash_type', $tipo);
    }
    
    public function getClientes($idTipo)
    {
        $clientes = Cliente::where('tipo', $idTipo)->get(['id', 'nome']);
        return response()->json($clientes);
    }
}
