<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLinhaProducaoMaterialTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('linha_producao_material', function (Blueprint $table) {
            $table->increments('id')->unique()->comment('Código identificador único da tabela');
            $table->integer('linha_producao')->unsigned()->comment('Código identificador da tabela linha_producao');
            $table->integer('material')->unsigned()->comment('Código identificador da tabela material');
            
            $table->foreign('linha_producao')->references('id')->on('linha_producao');
            $table->foreign('material')->references('id')->on('material');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('linha_producao_material');
    }
}
