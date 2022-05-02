<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateManifestoSeguroAverbacaosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('manifesto_seguro_averbacaos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('manifesto_id');
            $table->foreign('manifesto_id')->references('id')
                ->on('manifestos')->onDelete('cascade');

            $table->unsignedBigInteger('manifesto_seguro_id');
            $table->foreign('manifesto_seguro_id')->references('id')
                ->on('manifesto_seguros')->onDelete('cascade');

            $table->string('numero',40)->nullable()->default('');
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
        Schema::dropIfExists('manifesto_seguro_averbacaos');
    }
}
