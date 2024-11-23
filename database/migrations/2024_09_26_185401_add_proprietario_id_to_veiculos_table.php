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
    Schema::table('veiculos', function (Blueprint $table) {
        $table->foreignId('proprietario_id')->nullable()->constrained('pessoas')->onDelete('cascade');
    });
}

public function down()
{
    Schema::table('veiculos', function (Blueprint $table) {
        $table->dropForeign(['proprietario_id']);
        $table->dropColumn('proprietario_id');
    });
}
};
