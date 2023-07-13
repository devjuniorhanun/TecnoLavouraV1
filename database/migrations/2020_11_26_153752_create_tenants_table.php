<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTenantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tenants', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->string('nome')->unique();
            $table->string('cnpj')->unique();
            $table->string('inscricao')->unique();
            $table->string('url')->nullable();
            $table->string('email')->unique();
            $table->string('telefone')->nullable();
            $table->string('logo')->nullable();
            $table->enum('status', ["Ativa","Desativada"])->default('Ativa');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tenants');
    }
}
