<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChequeEmitidosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('cheque_emitidos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tenant_id')->constrained();
            $table->foreignId('produtor_id')->constrained();
            $table->uuid('uuid');
            $table->date('data_lancamento');
            $table->text('descricao_lancamento');
            $table->double('valor_lancamento', 10, 2)->nullable();
            $table->string('para_quem')->nullable();
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
        Schema::dropIfExists('cheque_emitidos');
    }
}
