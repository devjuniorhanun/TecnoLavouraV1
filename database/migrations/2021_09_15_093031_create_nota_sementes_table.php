<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotaSementesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('nota_sementes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tenant_id')->constrained();
            $table->foreignId('produtor_id')->constrained();
            $table->foreignId('fornecedor_id')->constrained();
            $table->foreignId('safra_id')->constrained();
            $table->uuid('uuid');
            $table->string('nota_fiscal')->nullable();
            $table->date('data_emissao');
            $table->date('data_chegada');
            $table->string('transportadora')->nullable();
            $table->json('sementes');
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
        Schema::dropIfExists('nota_sementes');
    }
}
