<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Produto extends Model
{
    //
    protected $table = 'produto';
    
    public static function listarOpicionais($produto)
    {
        return DB::select('SELECT o.id, o.nome '
                          . 'FROM opicional AS o '
                          . 'JOIN produto_opicional AS po ON po.opicional = o.id '
                         . 'WHERE po.produto = ?', [$produto]);
    }
    
    public static function getCores($produto)
    {
        return DB::select('SELECT c.id, c.nome '
                          . 'FROM cor AS c '
                          . 'JOIN produto_cor AS pc ON pc.cor = c.id '
                         . 'WHERE pc.produto = ?', [$produto]);
    }
    
    public static function getModelos($produto)
    {
        return DB::select('SELECT id, nome FROM produto_modelo WHERE produto = ?', [$produto]);
    }
}
