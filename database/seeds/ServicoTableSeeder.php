<?php

use Illuminate\Database\Seeder;

class ServicoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('servico')->insert([
            'id' => 1,
            'nome' => 'Novo produto',
            'ativo' => 1,
        ]);
        
        DB::table('servico')->insert([
            'id' => 2,
            'nome' => 'Serviço extra',
            'ativo' => 1,
        ]);
        
        DB::table('servico')->insert([
            'id' => 3,
            'nome' => 'Reparo na garantia',
            'ativo' => 1,
        ]);
    }
}
