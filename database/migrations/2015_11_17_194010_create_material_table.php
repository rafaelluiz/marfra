<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMaterialTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('material', function (Blueprint $table) {
            $table->increments('id')->unique()->comment('Código identificador único da tabela');
            $table->string('nome', 255)->unique()->comment('Nome do material');
            $table->decimal('espessura', 5,1)->nullable()->comment('Espessura do material');
            $table->decimal('barra', 5,4)->nullable()->comment('Tamanho da Barra do material');
            $table->boolean('ativo')->default(1)->comment('Flag que indica se o registro está ativo ou não');
            $table->timestamp('created_at')->comment('Data e hora em que o registro foi incluído');
            $table->timestamp('updated_at')->comment('Data e hora em que o registro foi alterado');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('material');
    }
}
