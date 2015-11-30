<?php

use Illuminate\Database\Seeder;

class CorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('cor')->insert([
            'id' => 1,
            'nome' => 'Anodização Bronze/Preta',
            'ativo' => 1,
        ]);
        
        DB::table('cor')->insert([
            'id' => 2,
            'nome' => 'Anodização Fosca',
            'ativo' => 1,
        ]);
        
        DB::table('cor')->insert([
            'id' => 3,
            'nome' => 'Pintura Branca',
            'ativo' => 1,
        ]);
        
        DB::table('cor')->insert([
            'id' => 4,
            'nome' => 'Pintura Verde',
            'ativo' => 1,
        ]);
        
        DB::table('cor')->insert([
            'id' => 5,
            'nome' => 'Incolor',
            'ativo' => 1,
        ]);
        
        DB::table('cor')->insert([
            'id' => 6,
            'nome' => 'Fumê',
            'ativo' => 1,
        ]);
        
        DB::table('cor')->insert([
            'id' => 7,
            'nome' => 'Verde',
            'ativo' => 1,
        ]);
        
        DB::table('cor')->insert([
            'id' => 8,
            'nome' => 'Bronze',
            'ativo' => 1,
        ]);
    }
}
