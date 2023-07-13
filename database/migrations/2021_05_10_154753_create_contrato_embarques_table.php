<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContratoEmbarquesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('contrato_embarques', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tenant_id')->constrained();
            $table->foreignId('safra_id')->constrained();
            //$table->foreignId('inscricao_estadual_id')->constrained();
            $table->foreignId('cultura_id')->constrained();
            $table->foreignId('fornecedor_id')->constrained();
            $table->uuid('uuid');
            $table->string('num_contrato')->nullable();
            //$table->double('quantidade', 10, 3)->nullable();
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
        Schema::dropIfExists('contrato_embarques');
    }
}
