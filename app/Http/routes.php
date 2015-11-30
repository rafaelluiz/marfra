<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
/*
Route::get('/', function () {
    return view('welcome');
});
*/
Route::get('/', 'IndexController@index');

// Authentication routes...
Route::get('login', ['as' =>'login', 'uses' => 'Auth\AuthController@getLogin']);
Route::post('login', ['as' =>'login', 'uses' => 'Auth\AuthController@postLogin']);
Route::get('logout', ['as' => 'logout', 'uses' => 'Auth\AuthController@getLogout']);

// ajax
Route::get('get-cidades/{idEstado}', 'CidadeController@getCidades');
Route::get('get-clientes/{idTipo}', 'ClienteController@getClientes');
Route::get('get-bloco-produtos/{idProduto}', 'OrcamentoTecnicoController@getBloco');
Route::get('get-bloco-opicional/{idOpicional}/{idBloco}', 'OrcamentoTecnicoController@getBlocoOpicional');

// usuarios
Route::get('usuarios', ['as' => 'usuarios', 'uses' => 'UsuarioController@index']);
Route::get('usuario/novo', ['as' => 'usuario.novo', 'uses' => 'UsuarioController@create']);
Route::post('usuario/novo', ['as' =>'usuario.novo', 'uses' => 'UsuarioController@store']);
Route::get('usuario/{id}/editar', 'UsuarioController@edit');
Route::get('usuario/{id}/excluir', 'UsuarioController@destroy');

// clientes
Route::get('clientes', ['as' => 'clientes', 'uses' => 'ClienteController@index']);
Route::get('cliente/novo', ['as' => 'cliente/novo', 'uses' => 'ClienteController@create']);
Route::post('cliente/novo', ['as' =>'cliente/novo', 'uses' => 'ClienteController@store']);
Route::get('cliente/editar/{id}', 'ClienteController@edit');
Route::get('cliente/excluir/{id}', 'ClienteController@destroy');

// atendimento
Route::get('atendimento/orcamentos', ['as' => 'atendimento/orcamentos', 'uses' => 'OrcamentoAtendimentoController@index']);
Route::get('atendimento/orcamento/novo', ['as' => 'atendimento/orcamento/novo', 'uses' => 'OrcamentoAtendimentoController@create']);
Route::get('atendimento/orcamento/novo/{idCliente}', ['as' => 'atendimento/orcamento/novo', 'uses' => 'OrcamentoAtendimentoController@create']);
Route::post('atendimento/orcamento/novo', ['as' => 'atendimento/orcamento/novo', 'uses' => 'OrcamentoAtendimentoController@store']);
Route::get('atendimento/orcamento/editar/{id}', 'OrcamentoAtendimentoController@edit');
Route::get('atendimento/orcamento/excluir/{id}', 'OrcamentoAtendimentoController@destroy');

// tecnico
Route::get('tecnico/orcamentos', ['as' => 'tecnico/orcamentos', 'uses' => 'OrcamentoTecnicoController@index']);
Route::get('tecnico/orcamento/editar/{id}', 'OrcamentoTecnicoController@edit');
Route::post('tecnico/orcamento/update', ['as' => 'tecnico/orcamento/update', 'uses' => 'OrcamentoTecnicoController@store']);

// projetista
Route::get('projetista/orcamentos', ['as' => 'projetista/orcamentos', 'uses' => 'OrcamentoProjetistaController@index']);
Route::get('projetista/orcamento/editar/{id}', 'OrcamentoProjetistaController@edit');
Route::post('projetista/orcamento/update', ['as' => 'projetista/orcamento/update', 'uses' => 'OrcamentoProjetistaController@store']);

// calculista
Route::get('calculista/orcamentos', ['as' => 'calculista/orcamentos', 'uses' => 'OrcamentoCalculistaController@index']);
Route::get('calculista/orcamento/editar/{id}', 'OrcamentoCalculistaController@edit');
Route::post('calculista/orcamento/update', ['as' => 'calculista/orcamento/update', 'uses' => 'OrcamentoCalculistaController@store']);