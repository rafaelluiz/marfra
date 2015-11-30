<?php

use Illuminate\Database\Seeder;

class LinhaProducaoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('linha_producao')->insert([
            'id' => 1,
            'nome' => 'Tubular Redondo',
            'ativo' => 1,
        ]);
        
        DB::table('linha_producao')->insert([
            'id' => 2,
            'nome' => 'Tubular Quadrado',
            'ativo' => 1,
        ]);
    }
}
