<?php

namespace App\Http\Controllers;

use App\Cidade;
use App\Http\Controllers\Controller;
use function response;

class CidadeController extends Controller
{
    //
    public function getCidades($idEstado)
    {
        $cidades = Cidade::where('estado', $idEstado)->get(['id', 'nome']);
        return response()->json($cidades);
    }
}
