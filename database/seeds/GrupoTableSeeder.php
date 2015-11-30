<?php

use Illuminate\Database\Seeder;

class GrupoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('grupo')->insert([
            'id' => 1,
            'nome' => 'Administrador',
            'ativo' => 1,
        ]);
        
        DB::table('grupo')->insert([
            'id' => 2,
            'nome' => 'Atendimento',
            'ativo' => 1,
        ]);
        
        DB::table('grupo')->insert([
            'id' => 3,
            'nome' => 'Projetista',
            'ativo' => 1,
        ]);
        
        DB::table('grupo')->insert([
            'id' => 4,
            'nome' => 'Calculista',
            'ativo' => 1,
        ]);
    }
}
