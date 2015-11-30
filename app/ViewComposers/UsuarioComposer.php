<?php

namespace App\ViewComposers;

use Illuminate\View\View;
use Illuminate\Http\Request;

class UsuarioComposer
{
    /**
     * The user repository implementation.
     *
     * @var UserRepository
     */
    protected $usuario;

    /**
     * Create a new profile composer.
     *
     * @param  Resquest  $request
     * @return void
     */
    public function __construct(Request $request)
    {
        // Dependencies automatically resolved by service container...
        $this->usuario = $request->user();
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('usuario', $this->usuario);
    }
}