<?php

use Illuminate\Database\Seeder;

class SubprodutoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('subproduto')->insert([
            'id' => 1,
            'conjunto' => 1,
            'nome' => 'Pedestre Elétrico',
            'ativo' => 1,
        ]);
        
        DB::table('subproduto')->insert([
            'id' => 2,
            'conjunto' => 1,
            'nome' => 'Pedestre Mecânico',
            'ativo' => 1,
        ]);
        
        DB::table('subproduto')->insert([
            'id' => 3,
            'conjunto' => 1,
            'nome' => 'Pivotante Duplo Elétrico',
            'ativo' => 1,
        ]);
        
        DB::table('subproduto')->insert([
            'id' => 4,
            'conjunto' => 1,
            'nome' => 'Pivotante Duplo Mecânico',
            'ativo' => 1,
        ]);
        
        DB::table('subproduto')->insert([
            'id' => 5,
            'conjunto' => 1,
            'nome' => 'Deslizante Elétrico',
            'ativo' => 1,
        ]);
        
        DB::table('subproduto')->insert([
            'id' => 6,
            'conjunto' => 1,
            'nome' => 'Deslizante com Motor',
            'ativo' => 1,
        ]);
        
        DB::table('subproduto')->insert([
            'id' => 7,
            'conjunto' => 1,
            'nome' => 'Deslizante Mecânico',
            'ativo' => 1,
        ]);
        
        DB::table('subproduto')->insert([
            'id' => 8,
            'conjunto' => 1,
            'nome' => 'Montante Móvel',
            'ativo' => 1,
        ]);
        
        DB::table('subproduto')->insert([
            'id' => 9,
            'conjunto' => 2,
            'nome' => 'Deslizante Comum',
            'ativo' => 1,
        ]);
        
        DB::table('subproduto')->insert([
            'id' => 10,
            'conjunto' => 2,
            'nome' => 'Deslizante Semi Industrial',
            'ativo' => 1,
        ]);
        
        DB::table('subproduto')->insert([
            'id' => 11,
            'conjunto' => 2,
            'nome' => 'Deslizante Industrial',
            'ativo' => 1,
        ]);
        
        DB::table('subproduto')->insert([
            'id' => 12,
            'conjunto' => 2,
            'nome' => 'Deslizante Mecânico',
            'ativo' => 1,
        ]);
        
        DB::table('subproduto')->insert([
            'id' => 13,
            'conjunto' => 3,
            'nome' => 'Pivotante Simples com Motor',
            'ativo' => 1,
        ]);
        
        DB::table('subproduto')->insert([
            'id' => 14,
            'conjunto' => 3,
            'nome' => 'Pivotante Simples Mecânico',
            'ativo' => 1,
        ]);
        
        DB::table('subproduto')->insert([
            'id' => 15,
            'conjunto' => 3,
            'nome' => 'Pivotante Duplo com Motor',
            'ativo' => 1,
        ]);
        
        DB::table('subproduto')->insert([
            'id' => 16,
            'conjunto' => 3,
            'nome' => 'Pivotante Duplo Mecânico',
            'ativo' => 1,
        ]);
        
        DB::table('subproduto')->insert([
            'id' => 17,
            'conjunto' => 3,
            'nome' => 'Pivo Robô',
            'ativo' => 1,
        ]);
        
        DB::table('subproduto')->insert([
            'id' => 18,
            'conjunto' => 4,
            'nome' => 'Basculante Horizontal',
            'ativo' => 1,
        ]);
        
        DB::table('subproduto')->insert([
            'id' => 19,
            'conjunto' => 4,
            'nome' => 'Basculante Vertical',
            'ativo' => 1,
        ]);
        
        DB::table('subproduto')->insert([
            'id' => 20,
            'conjunto' => 5,
            'nome' => 'Trilho Inferior',
            'ativo' => 1,
        ]);
        
        DB::table('subproduto')->insert([
            'id' => 21,
            'conjunto' => 5,
            'nome' => 'Travessão Removível',
            'ativo' => 1,
        ]);
    }
}
