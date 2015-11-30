<?php

use Illuminate\Database\Seeder;

class ClienteTipoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('cliente_tipo')->insert([
            'id' => 1,
            'nome' => 'Condomínio',
            'ativo' => 1,
        ]);
        
        DB::table('cliente_tipo')->insert([
            'id' => 2,
            'nome' => 'Empresa',
            'ativo' => 1,
        ]);
        
        DB::table('cliente_tipo')->insert([
            'id' => 3,
            'nome' => 'Governo',
            'ativo' => 1,
        ]);
        
        DB::table('cliente_tipo')->insert([
            'id' => 4,
            'nome' => 'Pessoa Física',
            'ativo' => 1,
        ]);
    }
}
