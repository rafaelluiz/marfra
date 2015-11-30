<?php

use Illuminate\Database\Seeder;

class ProdutoCorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('produto_cor')->insert([
            'id' => 1,
            'produto' => 1,
            'cor' => 1,
        ]);
        
        DB::table('produto_cor')->insert([
            'id' => 2,
            'produto' => 1,
            'cor' => 2,
        ]);
        
        DB::table('produto_cor')->insert([
            'id' => 3,
            'produto' => 1,
            'cor' => 3,
        ]);
        
        DB::table('produto_cor')->insert([
            'id' => 4,
            'produto' => 1,
            'cor' => 4,
        ]);
        
        DB::table('produto_cor')->insert([
            'id' => 5,
            'produto' => 2,
            'cor' => 1,
        ]);
        
        DB::table('produto_cor')->insert([
            'id' => 6,
            'produto' => 2,
            'cor' => 2,
        ]);
        
        DB::table('produto_cor')->insert([
            'id' => 7,
            'produto' => 2,
            'cor' => 3,
        ]);
        
        DB::table('produto_cor')->insert([
            'id' => 8,
            'produto' => 2,
            'cor' => 4,
        ]);
        
        DB::table('produto_cor')->insert([
            'id' => 9,
            'produto' => 3,
            'cor' => 1,
        ]);
        
        DB::table('produto_cor')->insert([
            'id' => 10,
            'produto' => 3,
            'cor' => 2,
        ]);
        
        DB::table('produto_cor')->insert([
            'id' => 11,
            'produto' => 3,
            'cor' => 3,
        ]);
        
        DB::table('produto_cor')->insert([
            'id' => 12,
            'produto' => 3,
            'cor' => 4,
        ]);
        
        DB::table('produto_cor')->insert([
            'id' => 13,
            'produto' => 4,
            'cor' => 1,
        ]);
        
        DB::table('produto_cor')->insert([
            'id' => 14,
            'produto' => 4,
            'cor' => 2,
        ]);
        
        DB::table('produto_cor')->insert([
            'id' => 15,
            'produto' => 4,
            'cor' => 3,
        ]);
        
        DB::table('produto_cor')->insert([
            'id' => 16,
            'produto' => 4,
            'cor' => 4,
        ]);
        
        DB::table('produto_cor')->insert([
            'id' => 17,
            'produto' => 5,
            'cor' => 1,
        ]);
        
        DB::table('produto_cor')->insert([
            'id' => 18,
            'produto' => 5,
            'cor' => 2,
        ]);
        
        DB::table('produto_cor')->insert([
            'id' => 19,
            'produto' => 5,
            'cor' => 3,
        ]);
        
        DB::table('produto_cor')->insert([
            'id' => 20,
            'produto' => 5,
            'cor' => 4,
        ]);
    }
}
