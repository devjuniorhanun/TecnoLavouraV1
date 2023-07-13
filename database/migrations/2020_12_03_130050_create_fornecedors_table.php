<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFornecedorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('fornecedors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tenant_id')->constrained()->cascadeOnDelete();
            $table->uuid('uuid');
            $table->string('razao_social')->unique();
            $table->string('nome_fantasia')->unique();
            $table->string('cpf_cnpj')->nullable()->unique();
            $table->string('rg_inscricao')->nullable()->unique();
            $table->enum('finalidade', ["ARMAZÉNS GERAIS","COMBUSTÍVEIS","COLHEDOR","FUNCIONÁRIO","GERAL","INSUMOS","USO CONSUMO","TRANSPORTADOR"]);
            $table->enum('tipo', ["FÍSICO","JURÍDICO"]);
            $table->string('email')->nullable();
            $table->string('telefone')->nullable();
            $table->string('celular')->nullable();
            $table->string('cep')->nullable();
            $table->string('estado')->nullable();
            $table->string('cidade')->nullable();
            $table->string('bairro')->nullable();
            $table->string('endereco')->nullable();
            $table->string('complmento')->nullable();
            $table->string('numero')->nullable();
            $table->string('nome_contato')->nullable();
            $table->string('email_contato')->nullable();
            $table->string('telefone_contato')->nullable();
            $table->enum('status', ["Ativo","Desativada"]);
            $table->string('nome_banco')->nullable();
            $table->string('banco')->nullable();
            $table->string('agencia')->nullable();
            $table->string('num_conta')->nullable();
            $table->string('pix')->nullable();
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
        Schema::dropIfExists('fornecedors');
    }
}
