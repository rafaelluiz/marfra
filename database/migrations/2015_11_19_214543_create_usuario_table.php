<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsuarioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuario', function (Blueprint $table) {
            $table->increments('id')->unique()->comment('Código identificador único da tabela');
            $table->string('nome', 255)->comment('Nome do usuário do sistema');
            $table->string('login', 60)->unique()->comment('Login do usuário do sistema');
            $table->string('password', 60)->comment('Senha do usuário do sistema');
            $table->string('cargo', 160)->comment('Cargo do usuário do sistema');
            $table->string('remember_token', 100)->nullable()->comment('Campo de configuração para o Laravel');
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
        Schema::drop('usuario');
    }
}
