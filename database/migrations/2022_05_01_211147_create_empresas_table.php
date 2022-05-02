<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpresasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empresas', function (Blueprint $table) {
            $table->id();
            $table->string('nome',60);
            $table->string('cnpj',14);
            $table->string('insc_estadual',14)->nullable();
            $table->string('endereco',60)->nullable();
            $table->string('numero',60)->nullable();
            $table->string('complemento',60)->nullable();
            $table->string('bairro',60)->nullable();
            $table->string('cep',8)->nullable();
            $table->unsignedBigInteger('estado_id')->default($value=12);
            $table->foreign('estado_id')->references('id')->on('estados');
            $table->unsignedBigInteger('municipio_id')->default($value=1161);
            $table->foreign('municipio_id')->references('id')->on('municipios');
            $table->string('telefone',20)->nullable();
            $table->string('celular',20)->nullable();
            $table->string('email',60)->nullable();
            $table->string('certificado')->nullable();
            $table->string('certificado_senha')->nullable();
            $table->string('image')->nullable();
            $table->smallInteger('ambiente')->nullable()->default(2);
            $table->boolean('ativo')->default($value=1);
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
        Schema::dropIfExists('empresas');
    }
}
