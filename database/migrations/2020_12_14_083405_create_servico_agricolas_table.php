<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicoAgricolasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('servico_agricolas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tenant_id')->constrained()->cascadeOnDelete();
            $table->foreignId('safra_id')->constrained()->cascadeOnDelete();
            $table->foreignId('cultura_id')->constrained()->cascadeOnDelete();
            $table->foreignId('talhao_id')->constrained()->cascadeOnDelete();
            $table->foreignId('tipo_operacao_agricula_id')->constrained()->cascadeOnDelete();
            $table->uuid('uuid');
            $table->date('data')->nullable();
            $table->integer('num_os')->nullable();
            $table->double('volume_bomba', 10, 3)->nullable();
            $table->double('vazao', 10, 3)->nullable();
            $table->double('capacidade_bomba', 10, 3)->nullable();
            $table->double('bomba_recomendada', 10, 3)->nullable();
            $table->double('bomba_usada', 10, 3)->nullable();
            $table->double('diferenca_bomba', 10, 3)->nullable();
            $table->double('area', 10, 2)->nullable();
            $table->text('observacao')->nullable();
            $table->enum('status', ["ABERTA","FINALIZADA","CANCELADA"]);
            $table->json('operadores');
            $table->json('produtos');
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
        Schema::dropIfExists('servico_agricolas');
    }
}
