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
        Schema::table('campanhas', function (Blueprint $table) {
            $table->decimal('meta_valor', 10, 2)->nullable()->after('data_fim');
            $table->string('categoria', 50)->default('geral')->after('meta_valor');
            $table->string('status', 20)->default('ativa')->after('categoria');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('campanhas', function (Blueprint $table) {
            $table->dropColumn(['meta_valor', 'categoria', 'status']);
        });
    }
};
