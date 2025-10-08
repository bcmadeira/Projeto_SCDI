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
        Schema::create('doacoes', function (Blueprint $table) {
            $table->id();
            $table->string('tipo_doacao', 100);
            $table->text('descricao')->nullable();
            $table->integer('quantidade')->nullable();
            $table->decimal('valor', 10, 2)->nullable();
            $table->date('data_doacao');
            $table->enum('status', ['ativa', 'encerrada']);
            $table->foreignId('instituicao_id')->constrained('instituicoes');
            $table->foreignId('doador_id')->constrained('doadores');
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
        Schema::dropIfExists('doacoes');
    }
};
