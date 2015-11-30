<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call(CorTableSeeder::class);
        $this->call(LinhaProducaoTableSeeder::class);
        $this->call(SubprodutoConjuntoTableSeeder::class);
        $this->call(SubprodutoTableSeeder::class);
        $this->call(MaterialTableSeeder::class);
        $this->call(LinhaProducaoMaterialTableSeeder::class);
        $this->call(ProdutoTableSeeder::class);
        $this->call(ProdutoCorTableSeeder::class);
        $this->call(ClienteFormaConhecimentoTableSeeder::class);
        $this->call(ClienteTipoTableSeeder::class);
        $this->call(GrupoTableSeeder::class);
        $this->call(MenuTableSeeder::class);
        $this->call(GrupoPermissao::class);
        $this->call(ServicoTableSeeder::class);
        $this->call(UsuarioTableSeeder::class);
        $this->call(UsuarioGrupoTableSeeder::class);

        Model::reguard();
    }
}
