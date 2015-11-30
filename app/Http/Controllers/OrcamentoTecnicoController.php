<?php

namespace App\Http\Controllers;

use App\GrupoPermissao;
use App\Http\Controllers\Controller;
use App\Menu;
use App\Orcamento;
use App\OrcamentoProduto;
use App\Produto;
use App\UsuarioGrupo;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Validator;
use function redirect;
use function view;

class OrcamentoTecnicoController extends Controller
{
    private $orcamento;
    
    public function __construct(Orcamento $orcamento)
    {
        $this->middleware('auth');
        $this->orcamento = $orcamento;
        view()->share('menu', 'tecnico/orcamentos');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        // obtendo a listagem de orçamentos
        $orcamentos = $this->orcamento->listarTecnico();
        
        // configurando o titulo e os breadcrumbs
        $titulo = 'Orçamentos';
        $breadcrumb = [['nome' => 'Listagem de Orçamentos', 'ultimo' => true]];

        // enviando dados para a view
        return view('tecnico.index')
                ->with('registros', $orcamentos)
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
        //
    }
    
    public function rules($envio)
    {
        $regras = [];
        $regras_especificas = [];
        
        if ($envio == 'confirmar') {
            $regras_especificas = [
                'produto' => 'required',
            ];
        }
        
        return array_merge($regras, $regras_especificas);
    }
    
    public function messages()
    {
        $obrigatorio = 'Esse campo é <b>obrigatório</b>';
        
        $retorno = [
            'produto.required' => $obrigatorio,
        ];
        
        return $retorno;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        // obtendo o tipo de envio
        $envio = $request->get('envio');

//        dd($request->all());
        
        // aplicando as validações
        $validator = Validator::make($request->all(), $this->rules($envio), $this->messages());
        
        $id = $request->get('id');
        
        // direcionando caso aconteça algum erro
        if ($validator->fails()) {
            return redirect('tecnico/orcamento/editar/'.$id)->withErrors($validator)->withInput();
        }
        
        // salvando o registro
        $retorno = $this->save($request);
        
        // tratamento para salvo com sucesso
        if ($retorno) {
            $tipo = 'success';
            $tratamento = ($envio == 'confirmar') ? 'confirmado' : 'alterado';
            
            switch ($envio) {
                case 'confirmar' : $redirect = 'tecnico/orcamento/editar/'.$id; $tratamento = 'confirmado'; break;
                case 'salvarEFechar' : $redirect = 'tecnico/orcamentos'; $tratamento = 'alterado'; break;
                case 'salvar' : $redirect = 'tecnico/orcamento/editar/'.$id; $tratamento = 'alterado'; break;
                case 'salvarELiberar' : $redirect = 'tecnico/orcamentos'; $tratamento = 'salvo e liberado'; break;
            }
            
            $mensagem = 'Orçamento '.$tratamento.' com sucesso!';
        
        } else {
            // redireciona caso erro
            return redirect('tecnico/orcamento/editar/'.$id)->withErrors($validator)->withInput();
        }
        
        // mensagens flash
        $request->session()->flash('flash_message', $mensagem);
        $request->session()->flash('flash_type', $tipo);

        // retorno
        return redirect($redirect);
    }
    
    public function save(Request $request)
    {
        $id = $request->get('id');
        $envio = $request->get('envio');
        
        switch ($envio) {
            case 'confirmar':
                $produtos = $request->get('produto');
                $retorno = $this->confirmar($id, $produtos);
            break;
        
            case 'salvarELiberar':
                $retorno = $this->liberar($request);
            break;
        
            default : 
                $retorno = true; 
            break;
        }
        
        return $retorno;
    }
    
    public function confirmar($id, $produtos)
    {
        $retorno = (new OrcamentoProduto)->updateProdutoOrcamento($produtos, $id);
        
        if ($retorno) {
            $orcamento = Orcamento::findOrNew($id);
            $orcamento->confirmado = 1;
            $retorno = $orcamento->update();
        }
        
        return $retorno;
    }
    
    public function liberar(Request $request)
    {
        $id = $request->get('id');
//        $retorno = (new OrcamentoProduto)->updateProdutoOrcamento($produtos, $id);
        
//        if ($retorno) {
            $orcamento = Orcamento::findOrNew($id);
            $orcamento->tec_orcamentista = 1;
            $retorno = $orcamento->update();
//        }
        
        return $retorno;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        // configurando o titulo e os breadcrumbs
        $titulo = 'Orçamentos';
        $breadcrumb = [['nome' => 'Listagem de Orçamentos', 'ultimo' => true]];
        
        // obtendo os dados do orçamento
        $orcamento = $this->orcamento->obterOrcamentoTecnico($id);
        
        // obtendo os produtos do orçamento
        $orcamento_produtos = OrcamentoProduto::where('orcamento', $id)->get(['produto']);
        
        // obtendos os produtos
        $produtos = Produto::where('ativo', 1)->get();
        
        // retorno
        return view('tecnico.form')
                ->with('orcamento', $orcamento[0])
                ->with('orcamento_produtos', $orcamento_produtos)
                ->with('produtos', $produtos)
                ->with('paginaTitulo', $titulo)
                ->with('paginaBreadcrumb', $breadcrumb);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
    
    public function getBloco($idProduto)
    {
        // alias com dados comuns (pasta e alias)
        $alias = 'blocos.prod-';
        
        // switch para configurar o template
        switch ($idProduto)
        {
            case 1: $redirect = $alias.'grades'; break;
            case 2: $redirect = $alias.'fechamento-vao'; break;
            case 3: $redirect = $alias.'portao-garagem'; break;
            case 4: $redirect = $alias.'porta-pedestre'; break;
            case 5: $redirect = $alias.'guarda-copo'; break;
            case 6: $redirect = $alias.'corrimao'; break;
        }
        
        // gerando um id randomicamente
        $id = md5($idProduto . date('d/m/Y H:i:s'));
        
        // cores do produto
        $cores = Produto::getCores($idProduto);
        
        // modelos do produto
        $modelos = Produto::getModelos($idProduto);
        
        // array com configurações
        $configuracao = [
            'id' => $id,
        ];
        
        // obtendo a listagem de opcionais
        $opicionais = Produto::listarOpicionais($idProduto);
        
        return view($redirect)
                ->with('configuracao', $configuracao)
                ->with('produto_id', $idProduto)
                ->with('opicionais', $opicionais)
                ->with('cores', $cores)
                ->with('modelos', $modelos);
    }
    
    public function getBlocoOpicional($idOpicional, $idBloco)
    {
        // alias com dados comuns (pasta e alias)
        $alias = 'blocos.sub-';
        
        // switch para configurar o template
        switch ($idOpicional)
        {
            case 1: $redirect = $alias.'paineis-grade'; break;
            case 2: $redirect = $alias.'paineis-vidro'; break;
            case 3: $redirect = $alias.'porta-pedestre'; break;
            case 4: $redirect = $alias.'portao-garagem'; break;
            case 5: $redirect = $alias.'painel-fixo-lateral'; break;
            case 6: $redirect = $alias.'painel-fixo-superior'; break;
            case 7: $redirect = $alias.'travessao-removivel'; break;
            case 8: $redirect = $alias.'trilho-piso'; break;
            case 9: $redirect = $alias.'porta-pedestre-embutida'; break;
        }
        
        // gerando um id randomicamente
        $id = md5($idOpicional . date('d/m/Y H:i:s'));
        
        // array com configurações
        $configuracao = [
            'id' => $id,
        ];
        
        return view($redirect)
                ->with('configuracao', $configuracao);
    }
}
