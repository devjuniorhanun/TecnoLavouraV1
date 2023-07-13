<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCaixasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('caixas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tenant_id')->constrained();
            $table->foreignId('controle_caixa_id')->constrained();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('centro_custo_id')->constrained()->cascadeOnDelete();
            $table->uuid('uuid');
            $table->date('data_lancamento');
            $table->text('descricao_lancamento');
            $table->enum('tipo_pagamento', ["CREDITO","DEBITO"]);
            $table->enum('adiantamento', ["SIM","NÃO"])->default('NÃO');
            $table->string('pagamento_para');
            $table->double('valor_lancamento', 10, 2)->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('caixas');
    }
}
