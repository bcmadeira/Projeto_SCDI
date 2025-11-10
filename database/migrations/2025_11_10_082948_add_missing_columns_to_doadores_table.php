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
        Schema::table('doadores', function (Blueprint $table) {
            $table->string('estado', 2)->nullable()->after('cidade');
            $table->string('cep', 9)->nullable()->after('estado');
            $table->string('senha', 255)->nullable()->after('email');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('doadores', function (Blueprint $table) {
            $table->dropColumn(['estado', 'cep', 'senha']);
        });
    }
};
