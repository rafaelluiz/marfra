<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Cliente extends Model
{
    //
    protected $table = 'cliente';
//    public $timestamps = false;
    
    public function listar()
    {
        return DB::select('select c.*, t.nome AS tipo from cliente AS c JOIN cliente_tipo AS t ON t.id = c.tipo ORDER BY c.nome');
    }
}
