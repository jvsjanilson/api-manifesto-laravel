<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateManifestoPercursoEstadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('manifesto_percurso_estados', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('manifesto_id');
            $table->foreign('manifesto_id')->references('id')
                ->on('manifestos')->onDelete('cascade');

            $table->unsignedBigInteger('estado_id')->default($value=12);
            $table->foreign('estado_id')->references('id')
                ->on('estados');

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
        Schema::dropIfExists('manifesto_percurso_estados');
    }
}
