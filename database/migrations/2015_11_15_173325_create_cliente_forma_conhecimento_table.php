<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClienteFormaConhecimentoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cliente_forma_conhecimento', function (Blueprint $table) {
            $table->increments('id')->unique()->comment('Código identificador único da tabela');
            $table->string('nome', 60)->unique()->comment('Nome da forma de conhecimento');
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
        Schema::drop('cliente_forma_conhecimento');
    }
}
