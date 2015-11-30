<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Orcamento;
use App\OrcamentoProduto;
use App\Produto;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\Response as Response2;
use Validator;
use function redirect;
use function view;

class OrcamentoProjetistaController extends Controller
{
    private $orcamento;
    
    public function __construct(Orcamento $orcamento)
    {
        $this->middleware('auth');
        $this->orcamento = $orcamento;
        view()->share('menu', 'projetista/orcamentos');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return Response2
     */
    public function index()
    {
        // obtendo a listagem de orçamentos
        $orcamentos = $this->orcamento->listarProjetista();
        
        // configurando o titulo e os breadcrumbs
        $titulo = 'Orçamentos';
        $breadcrumb = [['nome' => 'Listagem de Orçamentos', 'ultimo' => true]];

        // enviando dados para a view
        return view('projetista.index')
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
//        $obrigatorio = 'Esse campo é <b>obrigatório</b>';
        
        $retorno = [
//            'produto.required' => $obrigatorio,
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
            return redirect('projetista/orcamento/editar/'.$id)->withErrors($validator)->withInput();
        }
        
        // salvando o registro
        $retorno = $this->save($request);
        
        // tratamento para salvo com sucesso
        if ($retorno) {
            $tipo = 'success';
            $tratamento = ($envio == 'confirmar') ? 'confirmado' : 'alterado';
            
            switch ($envio) {
                case 'salvarEFechar' : $redirect = 'projetista/orcamentos'; $tratamento = 'alterado'; break;
                case 'salvar' : $redirect = 'projetista/orcamento/editar/'.$id; $tratamento = 'alterado'; break;
                case 'salvarELiberar' : $redirect = 'projetista/orcamentos'; $tratamento = 'salvo e liberado'; break;
            }
            
            $mensagem = 'Orçamento '.$tratamento.' com sucesso!';
        
        } else {
            // redireciona caso erro
            return redirect('projetista/orcamento/editar/'.$id)->withErrors($validator)->withInput();
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
    
    public function liberar(Request $request)
    {
        $id = $request->get('id');
//        $retorno = (new OrcamentoProduto)->updateProdutoOrcamento($produtos, $id);
        
//        if ($retorno) {
            $orcamento = Orcamento::findOrNew($id);
            $orcamento->projetista = 1;
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
        return view('projetista.form')
                ->with('orcamento', $orcamento[0])
                ->with('orcamento_produtos', $orcamento_produtos)
                ->with('produtos', $produtos)
                ->with('paginaTitulo', $titulo)
                ->with('paginaBreadcrumb', $breadcrumb);
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
        //
    }
}
