<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrcamentoProduto extends Model
{
    //
    protected $table = 'orcamento_produto';
    public $timestamps = false;
    
//    public function removerProdutosOrcamento($orcamento, $produtos)
//    {
//        if (count($produtos)>0) {
//            $string = implode(',', $produtos);
//            $sql = "DELETE FROM orcamento_produto WHERE orcamento = "
//        }
//    }

    public function updateProdutoOrcamento($produtos, $orcamento)
    {
        $retorno = true;
        
        // removo os produtos que não estão nessa listagem
        OrcamentoProduto::where('orcamento', $orcamento)
                        ->whereNotIn('produto', $produtos)
                        ->delete();
        
        // loop nos produtos informados
        foreach ($produtos as $produto) {
            
            // incluo se o produto não existir
            if (OrcamentoProduto::where('orcamento', $orcamento)->where('produto', $produto)->count() == 0) {
                $orcamentoProduto = new OrcamentoProduto();
                $orcamentoProduto->orcamento = $orcamento;
                $orcamentoProduto->produto = $produto;
                if (!$orcamentoProduto->save()) {
                    $retorno = false;
                    break;
                }
            }
        }
        
        return $retorno;
    }
}
