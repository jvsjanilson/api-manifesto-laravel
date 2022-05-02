<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateManifestoAutorizacaosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('manifesto_autorizacaos', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('manifesto_id');
            $table->foreign('manifesto_id')
                ->references('id')
                ->on('manifestos')
                ->onDelete('cascade');

            $table->string('cpfcnpj',14)->nullable();
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
        Schema::dropIfExists('manifesto_autorizacaos');
    }
}
