<?php

use Illuminate\Database\Seeder;

class GrupoPermissaoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('grupo_permissao')->insert([
            'id' => 1,
            'grupo' => 1,
            'menu' => 1,
        ]);
        
        DB::table('grupo_permissao')->insert([
            'id' => 2,
            'grupo' => 1,
            'menu' => 2,
        ]);
        
        DB::table('grupo_permissao')->insert([
            'id' => 3,
            'grupo' => 1,
            'menu' => 3,
        ]);
        
        DB::table('grupo_permissao')->insert([
            'id' => 4,
            'grupo' => 1,
            'menu' => 4,
        ]);
        
        DB::table('grupo_permissao')->insert([
            'id' => 5,
            'grupo' => 1,
            'menu' => 5,
        ]);
        
        DB::table('grupo_permissao')->insert([
            'id' => 6,
            'grupo' => 2,
            'menu' => 2,
        ]);
        
        DB::table('grupo_permissao')->insert([
            'id' => 7,
            'grupo' => 2,
            'menu' => 3,
        ]);
        
        DB::table('grupo_permissao')->insert([
            'id' => 8,
            'grupo' => 3,
            'menu' => 4,
        ]);
        
        DB::table('grupo_permissao')->insert([
            'id' => 9,
            'grupo' => 4,
            'menu' => 5,
        ]);
    }
}
