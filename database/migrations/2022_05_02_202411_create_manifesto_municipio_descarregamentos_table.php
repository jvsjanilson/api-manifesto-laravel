<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateManifestoMunicipioDescarregamentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('manifesto_municipio_descarregamentos', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('manifesto_id');
            $table->foreign('manifesto_id')
                ->references('id')
                ->on('manifestos')
                ->onDelete('cascade');

            $table->unsignedBigInteger('estado_id')->default($value=12);
            $table->foreign('estado_id')
                ->references('id')
                ->on('estados');

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
        Schema::dropIfExists('manifesto_municipio_descarregamentos');
    }
}
