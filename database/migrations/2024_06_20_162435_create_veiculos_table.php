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
        Schema::create('veiculos', function (Blueprint $table) {
            $table->id();
            $table->string('veiculo', 45)->nullable(false);
            $table->string('ano_modelo', 8);
            $table->string('placa', 7)->unique()->nullable(false);
            $table->string('renavam', 11)->unique()->nullable(false);
            $table->string('cor', 15)->nullable(false);
            $table->string('chassi', 20)->unique();
            $table->string('cod_seg_crv', 20)->unique();
            $table->string('cod_seg_cla', 20)->unique();
            $table->string('crv', 20)->unique();
            $table->string('atpve', 20)->unique();
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
        Schema::dropIfExists('veiculos');
    }
};
