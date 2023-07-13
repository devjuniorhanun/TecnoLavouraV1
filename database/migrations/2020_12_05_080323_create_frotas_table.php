<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFrotasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('frotas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tenant_id')->constrained()->cascadeOnDelete();
            $table->foreignId('grupo_frota_id')->constrained()->cascadeOnDelete();
            $table->uuid('uuid');
            $table->string('nome')->unique();
            $table->string('marca')->nullable();
            $table->string('modelo')->nullable();
            $table->string('ano')->nullable();
            $table->string('chassi')->nullable();
            $table->date('data_aquisicao')->nullable();
            $table->double('valor_aquisicao', 10, 2)->nullable();
            $table->double('volume_tanque', 10, 3)->nullable();
            $table->enum('combustivel', ["S-10","S-500","GASOLINA","ETANOL"])->nullable();
            $table->enum('tipo_marcacao', ["HORIMETRO","KILOMETRO"])->nullable();
            $table->double('medidor_inicial', 10, 3)->nullable();
            $table->double('medidor_final', 10, 3)->nullable();
            $table->text('observacao')->nullable();
            $table->enum('status', ["Ativo","Desativada"]);
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
        Schema::dropIfExists('frotas');
    }
}
