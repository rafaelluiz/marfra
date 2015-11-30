<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrcamentoProdutoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orcamento_produto', function (Blueprint $table) {
            $table->increments('id')->unique()->comment('Código identificador único da tabela');
            $table->integer('orcamento')->comment('Código identificador único da tabela orcamento');
            $table->integer('produto')->unsigned()->comment('Código identificador único da tabela produto');
            $table->integer('linha_producao')->unsigned()->nullable()->comment('Código identificador único da tabela linha_producao');
            $table->integer('cor')->unsigned()->nullable()->comment('Código identificador único da tabela cor');
            $table->decimal('comprimento', 5, 2)->nullable()->comment('Comprimento do produto (em metros)');
            $table->decimal('altura', 5, 2)->nullable()->comment('Altura do produto (em metros)');
            $table->tinyInteger('painel_grade')->nullable()->comment('Quantidade de painéis de grade');
            $table->tinyInteger('painel_vidro')->nullable()->comment('Quantidade de painéis de vidro');
            $table->tinyInteger('coluna_piso')->nullable()->comment('Quantidade de colunas no piso');
            $table->tinyInteger('coluna_mureta')->nullable()->comment('Quantidade de colunas na mureta');
            $table->timestamp('created_at')->comment('Data e hora em que o registro foi incluído');
            $table->timestamp('updated_at')->comment('Data e hora em que o registro foi alterado');
            
            $table->foreign('orcamento')->references('id')->on('orcamento');
            $table->foreign('produto')->references('id')->on('produto');
            $table->foreign('linha_producao')->references('id')->on('linha_producao');
            $table->foreign('cor')->references('id')->on('cor');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('orcamento_produto');
    }
}
