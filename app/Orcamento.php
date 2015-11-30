<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Orcamento extends Model
{
    //
    protected $table = 'orcamento';
    
    public function listar()
    {
        $sql = "SELECT o.id,
                       o.label,
                       ct.nome AS cliente_tipo,
                       c.nome AS cliente,
                       s.nome AS servico,
                       o.data_visita
                  FROM orcamento AS o
                  JOIN cliente AS c ON c.id = o.cliente
                  JOIN cliente_tipo AS ct ON ct.id = c.tipo
                  JOIN servico AS s ON s.id = o.servico
              ORDER BY o.label";
        
        return DB::select($sql);
    }
    
    public function listarTecnico()
    {
        $sql = "SELECT o.id,
                       o.label,
                       ct.nome AS cliente_tipo,
                       c.nome AS cliente,
                       o.tec_orcamentista,
                       o.created_at
                  FROM orcamento AS o
                  JOIN cliente AS c ON c.id = o.cliente
                  JOIN cliente_tipo AS ct ON ct.id = c.tipo
                  JOIN servico AS s ON s.id = o.servico
              ORDER BY o.label";
        
        return DB::select($sql);
    }
    
    public function obterOrcamentoTecnico($id)
    {
        $sql = "SELECT o.*, c.nome AS cliente, c.bairro, est.uf, cid.nome AS cidade, c.complemento, c.endereco, c.numero, DATE_FORMAT( o.created_at , '%d/%m/%Y %H:%i:%s' ) as created_at
                  FROM orcamento AS o
                  JOIN cliente AS c ON c.id = o.cliente
                  JOIN cliente_tipo AS ct ON ct.id = c.tipo
                  JOIN servico AS s ON s.id = o.servico
             LEFT JOIN cidade AS cid ON cid.id = c.cidade
             LEFT JOIN estado AS est ON est.id = c.estado
                 WHERE o.id = ?
              ORDER BY o.label LIMIT 1";
        
        return DB::select($sql, [$id]);
    }
    
    public function listarProjetista()
    {
        $sql = "SELECT o.id,
                       o.label,
                       ct.nome AS cliente_tipo,
                       c.nome AS cliente,
                       o.projetista,
                       o.created_at
                  FROM orcamento AS o
                  JOIN cliente AS c ON c.id = o.cliente
                  JOIN cliente_tipo AS ct ON ct.id = c.tipo
                  JOIN servico AS s ON s.id = o.servico
              ORDER BY o.label";
        
        return DB::select($sql);
    }
    
    public function listarCalculista()
    {
        $sql = "SELECT o.id,
                       o.label,
                       ct.nome AS cliente_tipo,
                       c.nome AS cliente,
                       o.calculista,
                       o.created_at
                  FROM orcamento AS o
                  JOIN cliente AS c ON c.id = o.cliente
                  JOIN cliente_tipo AS ct ON ct.id = c.tipo
                  JOIN servico AS s ON s.id = o.servico
              ORDER BY o.label";
        
        return DB::select($sql);
    }
}
