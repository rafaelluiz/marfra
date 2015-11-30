<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubprodutoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subproduto', function (Blueprint $table) {
            $table->increments('id')->unique()->comment('Código identificador único da tabela');
            $table->integer('conjunto')->unsigned()->comment('Código identificador da tabela subproduto_conjunto');
            $table->string('nome', 100)->comment('Nome do subproduto');
            $table->boolean('ativo')->default(1)->comment('Flag que indica se o registro está ativo ou não');
            $table->timestamp('created_at')->comment('Data e hora em que o registro foi incluído');
            $table->timestamp('updated_at')->comment('Data e hora em que o registro foi alterado');
            
            $table->foreign('conjunto')->references('id')->on('subproduto_conjunto');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('subproduto');
    }
}
