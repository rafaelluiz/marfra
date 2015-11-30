<?php

namespace App\Http\Controllers;

use App\Grupo;
use App\GrupoPermissao;
use App\Http\Controllers\Controller;
use App\Menu;
use App\Usuario;
use App\UsuarioGrupo;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response as Response2;
use Validator;
use function redirect;
use function view;

class UsuarioController extends Controller
{
    private $usuario_model;
    
    public function __construct(Usuario $usuario)
    {
        $this->middleware('auth');
        $this->usuario_model = $usuario;
        view()->share('menu', 'usuarios');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response2
     */
    public function index()
    {
        // obtendo a listagem de usuarios
        $usuarios = $this->usuario_model->listar();
        
        // formatando os grupos
        foreach ($usuarios as $usuario) {
            $grupos = $this->usuario_model->getGrupos($usuario->id);
            $arr_grupo = [];
            foreach ($grupos as $grupo) {
                $arr_grupo[] = $grupo->nome;
            }
            $usuario->grupo = implode(', ', $arr_grupo);
        }
        
        // configurando o titulo e os breadcrumbs
        $titulo = 'Usuários';
        $breadcrumb = [['nome' => 'Listagem de Usuários', 'ultimo' => true]];

        // enviando dados para a view
        return view('usuario.index')
                ->with('registros', $usuarios)
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
        // obtendo os grupos
        $grupos = Grupo::where('ativo', 1)->get();
        
        // configurando o titulo e os breadcrumbs
        $titulo = 'Cadastro';
        $breadcrumb = [
                        ['nome' => 'Usuário', 'ultimo' => false],
                        ['nome' => 'Novo Usuário', 'ultimo' => true],
            ];
        
        // enviando dados para a view
        return view('usuario.form')
                ->with('registro', new Usuario()) // enviando um obj vazio
                ->with('grupos', $grupos)
                ->with('paginaTitulo', $titulo)
                ->with('paginaBreadcrumb', $breadcrumb);
    }
    
    public function rules($id)
    {
        $regras_variaveis = [];
        
        if (empty($id)) {
            
            $regras_variaveis = [
                'password' => 'required',
                'password2' => 'required',
                'login' => 'required|min:2|unique:usuario',
            ];
        } else {
            $regras_variaveis = [
                'login' => 'required|min:2|unique:usuario,login,'.$id,
            ];
        }
        
        $regras = [
            'nome' => 'required',
            'grupo' => 'required',
            'cargo' => 'required',
            'ativo' => 'required',
        ];
        
        return array_merge($regras, $regras_variaveis);
    }

    public function messages()
    {
        $campo_obrigatorio = '* Esse campo é <strong>obrigatório.</strong>';
        
        return [
            'nome.required' => $campo_obrigatorio,
            'grupo.required' => $campo_obrigatorio,
            'cargo.required' => $campo_obrigatorio,
            'login.required' => $campo_obrigatorio,
            'ativo.required' => $campo_obrigatorio,
            'password.required' => $campo_obrigatorio,
            'password2.required' => $campo_obrigatorio,
            'login.min' => 'O Login precisa ter, no mínimo, 2 caracteres.',
            'login.unique' => 'O Login informado já está em uso.',
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
        // obtendo o id do registro
        $id = $request->get('id');
        
        // aplicando as validações
        $validator = Validator::make(
                $request->all(), 
                $this->rules($id), 
                $this->messages()
            );
        
        // configurando o redirect
        $redirect = (empty($id)) ? 'usuario/novo' : 'usuario/'.$id.'/editar';
        
        // direcionando caso aconteça algum erro
        if ($validator->fails()) {
            return redirect($redirect)->withErrors($validator)->withInput();
        }
        
        // salvando o usuario
        $retorno = $this->save($request);
        
        // tratamento para salvo com sucesso
        if ($retorno) {
            $tipo = 'success';
            $tratamento = (empty($id)) ? 'cadastrado' : 'alterado';
            $mensagem = 'Usuário '.$tratamento.' com sucesso!';
            
            switch ($request->get('envio')) {
                case 'salvarEFechar' : $redirect = 'usuarios'; break;
                case 'salvar' : $redirect = 'usuario/'.$retorno.'/editar'; break;
            }
        
        } else {
            // redireciona caso erro
            return redirect($redirect)->withErrors($validator)->withInput();
        }
        
        // mensagens flash
        $request->session()->flash('flash_message', $mensagem);
        $request->session()->flash('flash_type', $tipo);

        // retorno
        return redirect($redirect);
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
        // obtendo os dados do usuário
        $usuario = Usuario::findOrNew($id);
        
        // obtendo os grupos do usuário
        $usuario_grupos = $this->usuario_model->getGrupos($usuario->id);
        
        // injetando os grupos na classe de usuário
        $usuario->grupos = $usuario_grupos;
        
        // obtendo os grupos
        $grupos = Grupo::where('ativo', 1)->get();
        
        // configurando o titulo e os breadcrumbs
        $titulo = 'Cadastro';
        $breadcrumb = [
                        ['nome' => 'Usuário', 'ultimo' => false],
                        ['nome' => 'Editar Usuário', 'ultimo' => true],
            ];
        
        // enviando dados para a view
        return view('usuario.form')
                ->with('registro', $usuario) // enviando um obj vazio
                ->with('grupos', $grupos)
                ->with('paginaTitulo', $titulo)
                ->with('paginaBreadcrumb', $breadcrumb);
    }
    
    public function save(Request $request)
    {
        // buscando o objeto usuario (edição) ou criando um novo (inclusão)
        $id = $request->get('id');
        $objeto = Usuario::findOrNew($id);
        
        // setando os campos comuns e tratados
        $objeto->nome = $request->get('nome');
        $objeto->cargo = $request->get('cargo');
        $objeto->login = $request->get('login');
        $objeto->ativo = $request->get('ativo');
        $objeto->password = Hash::make($request->get('password'));
        
        // salvando o registro
        $retorno = (empty($id)) ? $objeto->save() : $objeto->update();
        
        if ($retorno) {
            if (empty($id)) {
                $retorno = $this->saveUsuarioGrupo($objeto->id, $request->get('grupo'));
            } else {
                $retorno = $this->updateUsuarioGrupo($objeto->id, $request->get('grupo'));
            }
        }
        
        // envio o id do registro, caso tenha ocorrido tudo certo
        return ($retorno) ? $objeto->id : false;
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
    
    public function saveUsuarioGrupo($usuario, $grupos)
    {
        $retorno = true;
        
        foreach ($grupos as $grupo) {
            $usuarioGrupo = new UsuarioGrupo();
            $usuarioGrupo->usuario = $usuario;
            $usuarioGrupo->grupo = $grupo;
            if (!$usuarioGrupo->save()) {
                $retorno = false;
                break;
            }
        }
        
        return $retorno;
    }
    
    public function updateUsuarioGrupo($usuario, $grupos)
    {
        $retorno = true;
        
        // removo os grupos que não estão nessa listagem
        UsuarioGrupo::where('usuario', $usuario)
                        ->whereNotIn('grupo', $grupos)
                        ->delete();
        
        // loop nos grupos informados
        foreach ($grupos as $grupo) {
            
            // incluo se o grupo não existir
            if (UsuarioGrupo::where('usuario', $usuario)->where('grupo', $grupo)->count() == 0) {
                $usuarioGrupo = new UsuarioGrupo();
                $usuarioGrupo->usuario = $usuario;
                $usuarioGrupo->grupo = $grupo;
                if (!$usuarioGrupo->save()) {
                    $retorno = false;
                    break;
                }
            }
        }
        
        return $retorno;
    }
}
