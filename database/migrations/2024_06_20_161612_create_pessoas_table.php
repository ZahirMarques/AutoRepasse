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
        Schema::create('pessoas', function (Blueprint $table) {
            $table->id();
            $table->string('nome', 45)->nullable(false);
            $table->string('cidade', 45)->nullable(false);
            $table->string('estado', 2)->nullable(false);
            $table->string('cpf', 14)->nullable(true); // Alterado para 14 caracteres
            $table->string('cnpj', 18)->nullable(true);
            $table->string('contato', 15)->nullable(true); // Corrigido "nullabe" para "nullable"
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
        Schema::dropIfExists('pessoas'); // Corrigido o nome para 'pessoas'
    }
};
