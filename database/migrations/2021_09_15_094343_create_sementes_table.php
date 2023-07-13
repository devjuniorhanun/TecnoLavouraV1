<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSementesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('sementes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tenant_id')->constrained();
            $table->foreignId('nota_semente_id')->constrained();
            $table->foreignId('safra_id')->constrained();
            $table->foreignId('grupo_produto_id')->constrained();
            $table->foreignId('sub_grupo_produto_id')->constrained();
            $table->foreignId('produto_id')->constrained();
            $table->foreignId('cultura_id')->constrained();
            $table->uuid('uuid');
            $table->string('lote')->nullable();
            $table->string('peneira')->nullable();
            $table->double('quantidade_embalagem', 10, 3)->nullable();
            $table->double('peso_embalagem', 10, 3)->nullable();
            $table->double('quantidade_semente', 10, 3)->nullable();
            $table->double('pms', 10, 3)->nullable(); 
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
        Schema::dropIfExists('sementes');
    }
}
