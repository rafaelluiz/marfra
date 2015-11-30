<?php

use Illuminate\Database\Seeder;

class UsuarioTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('usuario')->insert([
            'id' => 1,
            'nome' => 'Administrador',
            'login' => 'admin',
            'password' => bcrypt('123'),
            'cargo' => 'Administrador',
            'remember_token' => null,
            'ativo' => 1,
        ]);
    }
}
