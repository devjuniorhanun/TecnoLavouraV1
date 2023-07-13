<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLancamentoContaApagarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('lancamento_conta_apagars', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tenant_id')->constrained()->cascadeOnDelete();
            $table->foreignId('centro_custo_id')->constrained()->cascadeOnDelete();
            $table->foreignId('fornecedor_id')->constrained()->cascadeOnDelete();
            $table->uuid('uuid');
            $table->string('numero_documento');
            $table->date('data_documento');
            $table->date('data_vencimento');
            $table->text('descricao');
            $table->double('valor', 10, 2);
            $table->double('valor_desconto', 10, 2)->nullable();
            $table->enum('tipo', ["BOLETO","DINHEIRO","CHEQUE","TRANSFERÊNCIA"]);
            $table->enum('status', ["ABERTO","APAGO","CANCELADO"]);
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
        Schema::dropIfExists('lancamento_conta_apagars');
    }
}
