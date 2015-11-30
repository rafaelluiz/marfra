<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Usuario extends Model
{
    //
    protected $table = 'usuario';
    
    public function listar()
    {
        return DB::select('SELECT u.id, u.nome, u.cargo, u.login, u.ativo FROM usuario AS u');
    }
    
    public function getGrupos($usuario)
    {
        return DB::select('SELECT g.id, g.nome FROM usuario_grupo AS ug JOIN grupo AS g ON g.id = ug.grupo WHERE ug.usuario = ? ORDER BY g.id', [$usuario]);
    }
}
