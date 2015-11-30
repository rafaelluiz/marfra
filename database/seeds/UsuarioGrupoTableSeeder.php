<?php

use Illuminate\Database\Seeder;

class UsuarioGrupoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('usuario_grupo')->insert([
            'id' => 1,
            'usuario' => 1,
            'grupo' => 1,
        ]);
    }
}
