<?php

use Illuminate\Database\Seeder;

class MenuTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('menu')->insert([
            'id' => 1,
            'nome' => 'Usuários',
            'url' => 'usuarios',
            'icone' => 'fa-user',
            'ativo' => 1,
        ]);
        
        DB::table('menu')->insert([
            'id' => 2,
            'nome' => 'Clientes',
            'url' => 'clientes',
            'icone' => 'fa-user',
            'ativo' => 1,
        ]);
        
        DB::table('menu')->insert([
            'id' => 3,
            'nome' => 'Orçamentos',
            'url' => 'atendimento/orcamentos',
            'icone' => 'fa-dollar',
            'ativo' => 1,
        ]);
        
        DB::table('menu')->insert([
            'id' => 4,
            'nome' => 'Projetos',
            'url' => 'projetista/orcamentos',
            'icone' => 'fa-dollar',
            'ativo' => 1,
        ]);
        
        DB::table('menu')->insert([
            'id' => 5,
            'nome' => 'Calculista',
            'url' => 'calculista/orcamentos',
            'icone' => 'fa-dollar',
            'ativo' => 1,
        ]);
    }
}
