<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProdutosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('produtos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tenant_id')->constrained()->cascadeOnDelete();
            $table->foreignId('grupo_produto_id')->constrained()->cascadeOnDelete();
            $table->foreignId('sub_grupo_produto_id')->constrained()->cascadeOnDelete();
            $table->uuid('uuid');
            $table->string('nome')->unique();
            $table->string('unidade')->nullable();
            $table->string('mcm')->nullable();
            $table->double('estoque', 10, 3);
            $table->double('qtn_minima', 10, 3);
            $table->double('valor_unitario', 10, 3);
            $table->double('fator_conversao', 10,3);
            $table->enum('finalidade', ["Combustíveis","Insumos","Peças","Uso Consumo"])->default('Uso Consumo');
            $table->string('localizacao_estoque')->nullable();
            $table->enum('status', ["Ativo","Desativada"])->default('Ativo');
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
        Schema::dropIfExists('produtos');
    }
}
