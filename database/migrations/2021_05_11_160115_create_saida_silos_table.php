<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSaidaSilosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('saida_silos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tenant_id')->constrained()->cascadeOnDelete();
            $table->foreignId('safra_id')->constrained()->cascadeOnDelete();
            $table->foreignId('cultura_id')->constrained()->cascadeOnDelete();
            $table->foreignId('contrato_embarque_id')->constrained()->cascadeOnDelete();
            $table->foreignId('contrato_inscricao_id')->constrained()->cascadeOnDelete();
            $table->foreignId('motorista_id')->constrained()->cascadeOnDelete();
            $table->uuid('uuid');
            $table->double('primeira_pesagem', 10, 3)->nullable();
            $table->double('segunda_pesagam', 10, 3)->nullable();
            $table->double('umidade', 10, 3)->nullable();
            $table->double('impuresa', 10, 3)->nullable();
            $table->double('ardido', 10, 3)->nullable();
            $table->double('partido', 10, 3)->nullable();
            $table->double('avariado', 10, 3)->nullable();
            $table->double('desconto', 10, 3)->nullable();
            $table->double('peso_bruto', 10, 3)->nullable();
            $table->double('peso_liquido', 10, 3)->nullable();
            $table->double('saco_bruto', 10, 3)->nullable();
            $table->double('saco_liquido', 10, 3)->nullable();
            $table->enum('status', ["ABERTO","FECHADO"]);
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
        Schema::dropIfExists('saida_silos');
    }
}
