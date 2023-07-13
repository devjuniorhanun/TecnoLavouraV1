<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLancamentoSafrasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('lancamento_safras', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->foreignId('tenant_id')->constrained()->cascadeOnDelete();
            $table->foreignId('locacao_talhao_id')->constrained()->cascadeOnDelete();
            $table->foreignId('safra_id')->constrained()->cascadeOnDelete();
            $table->foreignId('cultura_id')->constrained()->cascadeOnDelete();
            $table->foreignId('variedade_cultura_id')->constrained()->cascadeOnDelete();
            $table->foreignId('talhao_id')->constrained()->cascadeOnDelete();
            $table->foreignId('motorista_id')->constrained()->cascadeOnDelete();
            $table->foreignId('motorista_fornecedor_id')->constrained('fornecedors')->cascadeOnDelete();
            $table->foreignId('proprietario_id')->constrained()->cascadeOnDelete();
            $table->foreignId('armazem_id')->constrained()->cascadeOnDelete();
            $table->foreignId('armazen_fornecedor_id')->constrained('fornecedors')->cascadeOnDelete();
            $table->foreignId('colhedor_id')->constrained()->cascadeOnDelete();
            $table->foreignId('colhedor_fornecedor_id')->constrained('fornecedors')->cascadeOnDelete();
            $table->foreignId('fazenda_id')->constrained()->cascadeOnDelete();
            $table->foreignId('matriz_frete_id')->constrained()->cascadeOnDelete();
            $table->date('data_colhido');
            $table->string('num_romaneio');
            $table->string('num_controle');
            $table->double('peso_bruto', 10, 3);
            $table->double('peso_desconto', 10, 3);
            $table->double('desconto', 10, 3);
            $table->double('peso_liquido', 10, 3);
            $table->double('saco_liquido', 10, 3);
            $table->double('saco_bruto', 10, 3);
            $table->double('valor_frete', 10, 2);
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
        Schema::dropIfExists('lancamento_safras');
    }
}
