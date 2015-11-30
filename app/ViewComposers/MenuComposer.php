<?php

namespace App\ViewComposers;

use App\GrupoPermissao;
use App\Menu;
use App\UsuarioGrupo;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class MenuComposer
{
    /**
     * The user repository implementation.
     *
     * @var UserRepository
     */
    protected $menus;
    
    /**
     * The user repository implementation.
     *
     * @var UserRepository
     */
    protected $permissao;

    /**
     * Create a new profile composer.
     *
     * @param  Resquest  $request
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->menus = Menu::where('ativo', 1)->get();
        
        // Dependencies automatically resolved by service container...
        $usuario = $request->user();
        
        $grupos = [];
        $grupos_usuario = UsuarioGrupo::where('usuario', $usuario->id)->get();
        if ($grupos_usuario) {
            foreach($grupos_usuario as $g) {
                $grupos[] = $g->grupo;
            }
        }
        
        $grupos_permissao = GrupoPermissao::where('grupo', $grupos)->get();
        
        if ($grupos_permissao) {
            foreach ($grupos_permissao as $gp) {
                $this->permissao[] = $gp->menu;
            }
        }
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('permissao', $this->permissao);
        $view->with('menus', $this->menus);
    }
}