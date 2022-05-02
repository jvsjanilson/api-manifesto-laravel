<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateManifestoSegurosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('manifesto_seguros', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('manifesto_id');
            $table->foreign('manifesto_id')->references('id')
                ->on('manifestos')->onDelete('cascade');

                $table->integer('resp_seg')->nullable()->default(1);
            $table->string('cpfcnpj',14)->nullable()->default('');
            $table->string('nome_seguradora',30)->nullable()->default('');
            $table->string('cnpj_seguradora',14)->nullable()->default('');
            $table->string('numero_apolice',20)->nullable()->default('');

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
        Schema::dropIfExists('manifesto_seguros');
    }
}
