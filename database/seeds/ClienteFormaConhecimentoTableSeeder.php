<?php

use Illuminate\Database\Seeder;

class ClienteFormaConhecimentoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('cliente_forma_conhecimento')->insert([
            'id' => 1,
            'nome' => 'Cliente antigo',
            'ativo' => 1,
        ]);
        
        DB::table('cliente_forma_conhecimento')->insert([
            'id' => 2,
            'nome' => 'Faixa',
            'ativo' => 1,
        ]);
        
        DB::table('cliente_forma_conhecimento')->insert([
            'id' => 3,
            'nome' => 'Indicação',
            'ativo' => 1,
        ]);
        
        DB::table('cliente_forma_conhecimento')->insert([
            'id' => 4,
            'nome' => 'Internet',
            'ativo' => 1,
        ]);
        
        DB::table('cliente_forma_conhecimento')->insert([
            'id' => 5,
            'nome' => 'Plaqueta',
            'ativo' => 1,
        ]);
        
        DB::table('cliente_forma_conhecimento')->insert([
            'id' => 6,
            'nome' => 'Veículos',
            'ativo' => 1,
        ]);
    }
}
