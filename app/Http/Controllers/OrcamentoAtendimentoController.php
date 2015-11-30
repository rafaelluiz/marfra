<?php

namespace App\Http\Controllers;

use App\Cliente;
use App\ClienteTipo;
use App\Http\Controllers\Controller;
use App\Orcamento;
use App\OrcamentoProduto;
use App\Produto;
use App\Servico;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Validator;
use function redirect;
use function view;

class OrcamentoAtendimentoController extends Controller
{
    private $orcamento;
    
    public function __construct(Orcamento $orcamento)
    {
        $this->middleware('auth');
        $this->orcamento = $orcamento;
        view()->share('menu', 'atendimento/orcamentos');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        // obtendo a listagem de orçamentos
        $orcamentos = $this->orcamento->listar();
        
        // configurando o titulo e os breadcrumbs
        $titulo = 'Orçamentos';
        $breadcrumb = [['nome' => 'Listagem de Orçamentos', 'ultimo' => true]];

        // enviando dados para a view
        return view('atendimento.index')
                ->with('registros', $orcamentos)
                ->with('paginaTitulo', $titulo)
                ->with('paginaBreadcrumb', $breadcrumb);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create($idCliente = null)
    {
        // iniciando o objeto vazio
        $orcamento = new Orcamento();
        
        // obtendo os tipos de clientes
        $tiposCliente = ClienteTipo::where('ativo', 1)->get();
        
        // obtendo os serviços
        $servicos = Servico::where('ativo', 1)->get();
        
        // obtendo os produtos principais
        $produtos = Produto::where('ativo', 1)->get();
        
        // iniciando variável do tipo de cliente
        $cliente_tipo = null;
        
        // verificando se foi passado algum código de cliente
        if ($idCliente) {
            $orcamento->cliente = $idCliente;
            $cliente = Cliente::findOrNew($idCliente);
            // se achou o cliente
            if ($cliente->id) {
                $cliente_tipo = $cliente->tipo;
            }
        }
        
        // configurando o titulo e os breadcrumbs
        $titulo = 'Cadastro';
        $breadcrumb = [
                        ['nome' => 'Orçamento', 'ultimo' => false],
                        ['nome' => 'Novo Orçamento', 'ultimo' => true],
            ];
        
        // enviando dados para a view
        return view('atendimento.form')
                ->with('orcamento', $orcamento) // enviando um obj vazio
                ->with('cliente_tipo', $cliente_tipo)
                ->with('tiposCliente', $tiposCliente)
                ->with('servicos', $servicos)
                ->with('produtos', $produtos)
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
        // buscanso os dados do orçamento
        $orcamento = Orcamento::findOrNew($id);
        
        // caso não encontre o orçamento, redireciona para o form de adição
        if (empty($orcamento->id)) {
            return redirect('atendimento/orcamentos')
                    ->with('flash_message', 'Orçamento não encontrado!')
                    ->with('flash_type', 'warning');
        }
        
        // tratando a data de nascimento
        $orcamento->data_visita = $this->tratarData($orcamento->data_visita, 2);

        // obtendo os tipos de clientes
        $tiposCliente = ClienteTipo::where('ativo', 1)->get();
        
        // obtendo os serviços
        $servicos = Servico::where('ativo', 1)->get();
        
        // obtendo os produtos principais
        $produtos = Produto::where('ativo', 1)->get();
        
        // obtendo os produtos vinculados ao orçamento
        $orcamento_produto = OrcamentoProduto::where('orcamento', $id)->get(['produto']);
        
        // obtendo o tipo de cliente
        $cliente_tipo = Cliente::where('id', $orcamento->cliente)->get(['tipo']);
        
        // configurando o titulo e os breadcrumbs
        $titulo = 'Edição';
        $breadcrumb = [
                        ['nome' => 'Orçamento', 'ultimo' => false],
                        ['nome' => 'Editar Orçamento', 'ultimo' => true],
            ];
        
        // enviando dados para a view
        return view('atendimento.form')
                ->with('orcamento', $orcamento)
                ->with('orcamento_produto', $orcamento_produto)
                ->with('cliente_tipo', $cliente_tipo[0]->tipo)
                ->with('tiposCliente', $tiposCliente)
                ->with('servicos', $servicos)
                ->with('produtos', $produtos)
                ->with('paginaTitulo', $titulo)
                ->with('paginaBreadcrumb', $breadcrumb);
    }
    
    public function rules()
    {
        return [];
    }
    
    public function messages()
    {
        return [];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        // aplicando as validações
        $validator = Validator::make($request->all(), $this->rules(), $this->messages());
        
        // direcionando caso aconteça algum erro
        if ($validator->fails()) {
            return redirect('atendimento/orcamento/novo')->withErrors($validator)->withInput();
        }
        
        // salvando o registro
        $retorno = $this->save($request);
        
        // tratamento para salvo com sucesso
        if ($retorno) {
            $tipo = 'success';
            $tratamento = (empty($request->get('id'))) ? 'cadastrado' : 'alterado';
            $mensagem = 'Orçamento '.$tratamento.' com sucesso!';
            
            switch ($request->get('envio')) {
                case 'salvarEFechar' : $redirect = 'atendimento/orcamentos'; break;
                case 'salvar' : $redirect = 'atendimento/orcamento/editar/'.$retorno; break;
            }
        
        } else {
            // redireciona caso erro
            return redirect('atendimento/orcamento/novo')->withErrors($validator)->withInput();
        }
        
        // mensagens flash
        $request->session()->flash('flash_message', $mensagem);
        $request->session()->flash('flash_type', $tipo);

        // retorno
        return redirect($redirect);
    }
    
    public function save(Request $request)
    {
        // buscando o objeto orçamento (edição) ou criando um novo (inclusão)
        $id = $request->get('id');
        $orcamento = Orcamento::findOrNew($id);
        
        // setando os campos comuns e tratados
        $orcamento->label = (empty($id)) ? $this->getNumeracaoOrcamento() : $orcamento->label;
        $orcamento->cliente = $request->get('cliente');
        $orcamento->servico = $request->get('servico');
        $orcamento->responsavel = $request->get('responsavel');
        $orcamento->telefone = $request->get('telefone');
        $orcamento->responsavel_alternativo = $request->get('responsavel_alternativo');
        $orcamento->telefone_alternativo = $request->get('telefone_alternativo');
        $orcamento->observacoes = $request->get('observacoes');
        $orcamento->data_visita = $this->tratarData($request->get('data_visita'));
        
        // salvando o registro
        $retorno = (empty($id)) ? $orcamento->save() : $orcamento->update();

        // salvando os produtos
        if ($retorno && empty($id)) {
            $retorno = $this->saveProdutoOrcamento($request, $orcamento->id);
        } else {
            $retorno = $this->updateProdutoOrcamento($request, $orcamento->id);
        }
        
        // envio o id do cliente, caso tenha ocorrido tudo certo
        return ($retorno) ? $orcamento->id : false;
    }
    
    public function saveProdutoOrcamento(Request $request, $orcamento)
    {
        $produtos = $request->get('produto');
        $retorno = true;
        
        foreach ($produtos as $produto) {
            $orcamentoProduto = new OrcamentoProduto();
            $orcamentoProduto->orcamento = $orcamento;
            $orcamentoProduto->produto = $produto;
            if (!$orcamentoProduto->save()) {
                $retorno = false;
                break;
            }
        }
        
        return $retorno;
    }
    
    public function updateProdutoOrcamento(Request $request, $orcamento)
    {
        $produtos = $request->get('produto');
        $retorno = true;
        
        // removo os produtos que não estão nessa listagem
        OrcamentoProduto::where('orcamento', $orcamento)
                        ->whereNotIn('produto', $produtos)
                        ->delete();
        
        // loop nos produtos informados
        foreach ($produtos as $produto) {
            
            // incluo se o produto não existir
            if (OrcamentoProduto::where('orcamento', $orcamento)->where('produto', $produto)->count() == 0) {
                $orcamentoProduto = new OrcamentoProduto();
                $orcamentoProduto->orcamento = $orcamento;
                $orcamentoProduto->produto = $produto;
                if (!$orcamentoProduto->save()) {
                    $retorno = false;
                    break;
                }
            }
        }
        
        return $retorno;
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
    
    public function getNumeracaoOrcamento()
    {
        $ano = date('Y');
        $label = Orcamento::where('label','<>','')->max('label');
        $retorno = $ano . '000001';
        
        if ($label) {
            if (substr($label, 0, 4) == $ano) {
                $numero = (int) substr($label, 4, 6);
                $numero++;
                $retorno = $ano . str_pad($numero, 6, '0', STR_PAD_LEFT);
            }
        }
        
        return $retorno;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        // buscando o orçamento
        $orcamento = Orcamento::findOrNew($id);
        
        // caso não encontre o orçamento redireciona para a tela de atendimento
        if (empty($orcamento->id)) {
            return redirect('atendimento/orcamentos')
                    ->with('flash_message', 'Orçamento não encontrado!')
                    ->with('flash_type', 'warning');
        }
        
        // deletando os produtos do orçamento
        if (!OrcamentoProduto::where('orcamento', $orcamento->id)->delete()) {
            $mensagem = 'Ocorreu um erro ao tentar excluir os produtos do orçamento.';
            $tipo = 'error';
        } else {
            // deletando o orçamento
            if ($orcamento->delete()) {
                $mensagem = 'Orçamento excluído com sucesso!';
                $tipo = 'success';
            } else {
                $mensagem = 'Ocorreu um erro ao tentar excluir o orçamento.';
                $tipo = 'error';
            }
        }
        
        // retornando com as mensagens
        return redirect('atendimento/orcamentos')
                    ->with('flash_message', $mensagem)
                    ->with('flash_type', $tipo);
    }
}
