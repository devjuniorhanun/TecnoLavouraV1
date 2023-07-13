<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProdutorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('produtors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tenant_id')->constrained()->cascadeOnDelete();
            $table->uuid('uuid');
            $table->string('razao_social')->unique();
            $table->string('nome_fantasia')->unique();
            $table->string('abreviacao')->unique();
            $table->enum('tipo_pagamento', ["Depósito","Transferência"])->default('Depósito');
            $table->enum('tipo', ["Física","Jurídica"])->default('Física');
            $table->date('data_nascimento')->nullable();
            $table->string('nascionalidade')->nullable();
            $table->string('naturalidade')->nullable();
            $table->enum('estado_civel', ["Solteiro(a)","Casado(a)","Viuvo(a)"])->default('Solteiro(a)');
            $table->string('cpf_cnpj')->nullable();
            $table->string('rg_inscriacao')->nullable();
            $table->string('email')->nullable();
            $table->string('telefone')->nullable();
            $table->string('celular')->nullable();
            $table->enum('status', ["Ativa","Desativada"])->default('Ativa');
            $table->string('cep')->nullable();
            $table->string('estado')->nullable();
            $table->string('cidade')->nullable();
            $table->string('bairro')->nullable();
            $table->string('endereco')->nullable();
            $table->string('complemento')->nullable();
            $table->string('numero')->nullable();
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
        Schema::dropIfExists('produtors');
    }
}
