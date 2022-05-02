<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateManifestoTracaosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('manifesto_tracaos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('manifesto_id');
            $table->foreign('manifesto_id')->references('id')
                ->on('manifestos')->onDelete('cascade');
            $table->integer('vtracao_rntrc')->nullable();
            $table->integer('vtracao_cint')->nullable();
            $table->string('vtracao_placa',7)->nullable();
            $table->string('vtracao_renavam',11)->nullable();
            $table->integer('vtracao_tara')->nullable();
            $table->integer('vtracao_capkg')->nullable();
            $table->integer('vtracao_capm3')->nullable();
            $table->integer('vtracao_tprod')->nullable();
            $table->integer('vtracao_tpcar')->nullable();
            $table->string('vtracao_uf',2)->nullable();
            $table->integer('vtracao_prop')->nullable()->default(0);
            $table->integer('vtracao_prop_rntrc')->nullable();
            $table->integer('vtracao_prop_tpprop')->nullable();
            $table->string('vtracao_prop_uf',2)->nullable();
            $table->string('vtracao_prop_cpfcnpj',14)->nullable();
            $table->string('vtracao_prop_nome',60)->nullable();
            $table->string('vtracao_prop_ie',14)->nullable();
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
        Schema::dropIfExists('manifesto_tracaos');
    }
}
