<?php

use Illuminate\Database\Seeder;

class MaterialTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('material')->insert([
            'id' => 1,
            'nome' => 'Tubo redondo 4"',
            'espessura' => 1.5,
            'barra' => 6.7734,
            'ativo' => 1,
        ]);
        
        DB::table('material')->insert([
            'id' => 2,
            'nome' => 'Tubo redondo 3"',
            'espessura' => 1.3,
            'barra' => 4.86,
            'ativo' => 1,
        ]);
        
        DB::table('material')->insert([
            'id' => 3,
            'nome' => 'Tubo redondo 2"',
            'espessura' => 1.1,
            'barra' => 2.79,
            'ativo' => 1,
        ]);
        
        DB::table('material')->insert([
            'id' => 4,
            'nome' => 'Tubo redondo 1 1/2"',
            'espessura' => 1.2,
            'barra' => 2.262,
            'ativo' => 1,
        ]);
        
        DB::table('material')->insert([
            'id' => 5,
            'nome' => 'Tubo redondo 3/8"',
            'espessura' => 1.6,
            'barra' => 0.642,
            'ativo' => 1,
        ]);
        
        DB::table('material')->insert([
            'id' => 6,
            'nome' => 'Trilho superior AL2902',
            'espessura' => null,
            'barra' => 3.588,
            'ativo' => 1,
        ]);
        
        DB::table('material')->insert([
            'id' => 7,
            'nome' => 'Jota B434',
            'espessura' => null,
            'barra' => 2.43,
            'ativo' => 1,
        ]);
        
        DB::table('material')->insert([
            'id' => 8,
            'nome' => 'Cantoneira 1"',
            'espessura' => 2.4,
            'barra' => 1.872,
            'ativo' => 1,
        ]);
        
        DB::table('material')->insert([
            'id' => 9,
            'nome' => 'Cantoneira 1" x 1 1/4"',
            'espessura' => 2,
            'barra' => 2.622,
            'ativo' => 1,
        ]);
        
        DB::table('material')->insert([
            'id' => 10,
            'nome' => 'Cantoneira 1" x 1/16"',
            'espessura' => 1.6,
            'barra' => 1.272,
            'ativo' => 1,
        ]);
        
        DB::table('material')->insert([
            'id' => 11,
            'nome' => 'Requadro vidro',
            'espessura' => null,
            'barra' => null,
            'ativo' => 1,
        ]);
        
        DB::table('material')->insert([
            'id' => 12,
            'nome' => 'Baguete',
            'espessura' => null,
            'barra' => null,
            'ativo' => 1,
        ]);
        
        DB::table('material')->insert([
            'id' => 13,
            'nome' => 'Tubo quadrado 80x80 mm (GRADE)',
            'espessura' => 1.8,
            'barra' => 9.156,
            'ativo' => 1,
        ]);
        
        DB::table('material')->insert([
            'id' => 14,
            'nome' => 'Tubo retangular 2 3/8" x 1 1/2" (60x38 mm) (GRADE)',
            'espessura' => null,
            'barra' => 5.25,
            'ativo' => 1,
        ]);
        
        DB::table('material')->insert([
            'id' => 15,
            'nome' => 'Tubo quadrado 1 1/2" x 1 1/2" (38x38 mm) (GRADE)',
            'espessura' => 1.2,
            'barra' => 2.88,
            'ativo' => 1,
        ]);
        
        DB::table('material')->insert([
            'id' => 16,
            'nome' => 'Tubo retangular 80x40 mm (PORTÃO)',
            'espessura' => 1.5,
            'barra' => 5.706,
            'ativo' => 1,
        ]);
        
        DB::table('material')->insert([
            'id' => 17,
            'nome' => 'Tubo retangular 2" x 1 1/2" mm (PORTÃO)',
            'espessura' => 1.5,
            'barra' => 4.188,
            'ativo' => 1,
        ]);
        
        DB::table('material')->insert([
            'id' => 18,
            'nome' => 'Tubo retangular 2 x 1/2"(RÉGUA)',
            'espessura' => 1.1,
            'barra' => 2.19,
            'ativo' => 1,
        ]);
        
        DB::table('material')->insert([
            'id' => 19,
            'nome' => 'Veneziana Ventilada',
            'espessura' => null,
            'barra' => 1.518,
            'ativo' => 1,
        ]);
        
        DB::table('material')->insert([
            'id' => 20,
            'nome' => 'Lambri LB8',
            'espessura' => null,
            'barra' => 3.744,
            'ativo' => 1,
        ]);
        
        DB::table('material')->insert([
            'id' => 21,
            'nome' => 'Cantoneira 3/4"',
            'espessura' => 1.6,
            'barra' => 0.942,
            'ativo' => 1,
        ]);
        
        DB::table('material')->insert([
            'id' => 22,
            'nome' => 'Cantoneira 1" x 1/8"',
            'espessura' => 2.4,
            'barra' => 1.872,
            'ativo' => 1,
        ]);
        
        DB::table('material')->insert([
            'id' => 23,
            'nome' => 'Cantoneira 2" x 1 1/4"',
            'espessura' => 2,
            'barra' => 2.622,
            'ativo' => 1,
        ]);
        
        DB::table('material')->insert([
            'id' => 24,
            'nome' => 'Perfil T 1"',
            'espessura' => 1.3,
            'barra' => 1.266,
            'ativo' => 1,
        ]);
    }
}
