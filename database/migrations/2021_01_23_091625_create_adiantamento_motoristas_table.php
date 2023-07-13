<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdiantamentoMotoristasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('adiantamento_motoristas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tenant_id')->constrained()->cascadeOnDelete();
            $table->foreignId('safra_id')->constrained()->cascadeOnDelete();
            $table->foreignId('fornecedor_id')->constrained()->cascadeOnDelete();
            $table->foreignId('produtor_id')->constrained()->cascadeOnDelete();
            $table->uuid('uuid');
            $table->date('data_pagamento');
            $table->double('valor_pagamento', 10, 2);
            //$table->enum('tipo_fornecedor', ["TRANSPORTADOR","COLHEDOR"]);
            $table->enum('tipo_adiantamento', ["DINHEIRO","CHEQUE","DEPOSITO","DIESEL"]);
            $table->string('nome_fornecedor')->nullable();
            $table->string('cpf_cnpj')->nullable();
            $table->string('nome_banco')->nullable();
            $table->string('agencia')->nullable();
            $table->string('num_conta')->nullable();
            $table->string('num_cheque')->nullable();
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
        Schema::dropIfExists('adiantamento_motoristas');
    }
}
