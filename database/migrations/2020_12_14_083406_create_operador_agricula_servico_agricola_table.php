<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOperadorAgriculaServicoAgricolaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('operador_agricula_servico_agricola', function (Blueprint $table) {
            $table->foreignId('operador_agricula_id')->constrained()->cascadeOnDelete();
            $table->foreignId('servico_agricola_id')->constrained()->cascadeOnDelete();
            $table->string('tipo_operador');
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
        Schema::dropIfExists('operador_agricula_servico_agricola');
    }
}
