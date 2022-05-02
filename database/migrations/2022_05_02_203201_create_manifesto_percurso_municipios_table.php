<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateManifestoPercursoMunicipiosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('manifesto_percurso_municipios', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('manifesto_id');
            $table->foreign('manifesto_id')
                ->references('id')
                ->on('manifestos')
                ->onDelete('cascade');

            $table->unsignedBigInteger('municipio_id')->default($value=1161);
            $table->foreign('municipio_id')
                ->references('id')
                ->on('municipios');

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
        Schema::dropIfExists('manifesto_percurso_municipios');
    }
}
