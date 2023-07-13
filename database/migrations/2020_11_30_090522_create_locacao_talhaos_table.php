<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLocacaoTalhaosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('locacao_talhaos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tenant_id')->constrained()->cascadeOnDelete();
            $table->foreignId('safra_id')->constrained()->cascadeOnDelete();
            $table->foreignId('cultura_id')->constrained()->cascadeOnDelete();
            $table->foreignId('variedade_cultura_id')->constrained()->cascadeOnDelete();
            $table->foreignId('talhao_id')->constrained()->cascadeOnDelete();
            $table->uuid('uuid');
            $table->double('area_plantada', 10, 2);
            $table->string('semente_linear')->nullable();
            $table->string('semente_populacao')->nullable();
            $table->date('inicio_plantio')->nullable();
            $table->date('final_plantio')->nullable();
            $table->date('data_prevista')->nullable();
            $table->text('observacoes')->nullable();
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
        Schema::dropIfExists('locacao_talhaos');
    }
}
