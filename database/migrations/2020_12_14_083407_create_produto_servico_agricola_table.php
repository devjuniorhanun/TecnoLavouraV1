<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProdutoServicoAgricolaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('produto_servico_agricola', function (Blueprint $table) {
            $table->id();
            $table->foreignId('safra_id')->constrained()->cascadeOnDelete();
            $table->foreignId('cultura_id')->constrained()->cascadeOnDelete();
            $table->foreignId('talhao_id')->constrained()->cascadeOnDelete();
            $table->foreignId('tipo_operacao_agricula_id')->constrained()->cascadeOnDelete();
            $table->foreignId('produto_id')->constrained()->cascadeOnDelete();
            $table->foreignId('servico_agricola_id')->constrained()->cascadeOnDelete();
            $table->double('dosagem', 10, 3)->nullable();
            $table->double('quantidade', 10, 3)->nullable();
            $table->double('dosagem_real', 10, 3)->nullable();
            $table->double('quantidade_real', 10, 3)->nullable();
            $table->double('fator_conversao', 10, 3)->nullable();
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
        Schema::dropIfExists('produto_servico_agricola');
    }
}
