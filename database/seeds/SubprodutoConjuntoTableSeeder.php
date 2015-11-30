<?php

use Illuminate\Database\Seeder;

class SubprodutoConjuntoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('subproduto_conjunto')->insert([
            'id' => 1,
            'nome' => 'Pedestres',
            'ativo' => 1,
        ]);
        
        DB::table('subproduto_conjunto')->insert([
            'id' => 2,
            'nome' => 'Deslizantes',
            'ativo' => 1,
        ]);
        
        DB::table('subproduto_conjunto')->insert([
            'id' => 3,
            'nome' => 'Pivotantes',
            'ativo' => 1,
        ]);
        
        DB::table('subproduto_conjunto')->insert([
            'id' => 4,
            'nome' => 'Basculantes',
            'ativo' => 1,
        ]);
        
        DB::table('subproduto_conjunto')->insert([
            'id' => 5,
            'nome' => 'Barras',
            'ativo' => 1,
        ]);
    }
}
