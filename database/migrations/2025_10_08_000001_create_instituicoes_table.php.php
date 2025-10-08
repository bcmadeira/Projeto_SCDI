<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('instituicoes', function (Blueprint $table) {
            $table->id();
            $table->string('nome', 100);
            $table->string('cnpj', 14);
            $table->string('ramo', 100);
            $table->string('telefone', 20)->nullable();
            $table->string('telefone2', 20)->nullable();
            $table->string('localizacao', 300)->nullable();
            $table->string('endereco', 150);
            $table->string('cidade', 100);
            $table->string('cep', 8);
            $table->string('email', 100);
            $table->text('descricao')->nullable();
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
        Schema::dropIfExists('instituicoes');
    }
};
