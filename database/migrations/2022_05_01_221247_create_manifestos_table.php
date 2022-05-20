<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateManifestosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('manifestos', function (Blueprint $table) {
            $table->unsignedBigInteger('empresa_id');
            $table->foreign('empresa_id')->references('id')->on('empresas');
            $table->id();
            $table->string('modelo',2)->nullable()->default('58');
            $table->integer('serie')->nullable()->default(1);
            $table->integer('numero')->nullable();
            $table->integer('codigo_mdfe')->nullable();
            $table->string('chave',44)->nullable();
            $table->string('protocolo',20)->nullable();
            $table->string('recibo',20)->nullable();
            $table->integer('modal')->nullable();
            $table->integer('tipoemit')->nullable();
            $table->integer('tipotransp')->nullable();
            $table->dateTime('datahora')->nullable();
            $table->string('ufini',2)->nullable();
            $table->string('uffim',2)->nullable();
            $table->decimal('valor_carga',15,2)->nullable()->default(0);
            $table->decimal('quant_carga',15,4)->nullable()->default(0);
            $table->string('cunid',2)->nullable();
            $table->string('infofisco')->nullable();
            $table->string('infocompl')->nullable();
            $table->integer('situacao')->nullable()->default(1); //1-Digitado, 2-Transmitido, 3-Encerrado, 4-Cancelado
            $table->string('xml')->nullable();
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
        Schema::dropIfExists('manifestos');
    }
}
