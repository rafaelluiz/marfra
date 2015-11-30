<?php

use Illuminate\Database\Seeder;

class ProdutoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('produto')->insert([
            'id' => 1,
            'label' => '00001',
            'nome' => 'Grade',
            'ativo' => 1,
        ]);
        
        DB::table('produto')->insert([
            'id' => 2,
            'label' => '00002',
            'nome' => 'Portão de garagem',
            'ativo' => 1,
        ]);
        
        DB::table('produto')->insert([
            'id' => 3,
            'label' => '00003',
            'nome' => 'Porta de pedestre',
            'ativo' => 1,
        ]);
        
        DB::table('produto')->insert([
            'id' => 4,
            'label' => '00004',
            'nome' => 'Guarda corpo',
            'ativo' => 1,
        ]);
        
        DB::table('produto')->insert([
            'id' => 5,
            'label' => '00005',
            'nome' => 'Corrimão',
            'ativo' => 1,
        ]);
    }
}
