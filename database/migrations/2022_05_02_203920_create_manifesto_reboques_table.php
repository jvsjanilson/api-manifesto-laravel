<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateManifestoReboquesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('manifesto_reboques', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('manifesto_id');
            $table->foreign('manifesto_id')->references('id')
                ->on('manifestos')->onDelete('cascade');
            $table->integer('reboque_codigo_veiculo')->nullable()->default(0);
            $table->string('reboque_placa',7)->nullable()->default('');
            $table->string('reboque_renavam',11)->nullable()->default('');
            $table->integer('reboque_tara')->nullable()->default(0);
            $table->integer('reboque_capkg')->nullable()->default(0);
            $table->integer('reboque_capm3')->nullable()->default(0);
            $table->integer('reboque_tpcar')->nullable()->default(0);
            $table->string('reboque_uf',2)->nullable()->default('');
            $table->string('reboque_cod_agporto',16)->nullable()->default('');
            $table->integer('reboque_prop')->nullable()->default(0);
            $table->string('reboque_prop_cpfcnpj',14)->nullable()->default('');
            $table->integer('reboque_prop_rntrc')->nullable()->default(0);
            $table->string('reboque_prop_nome',60)->nullable()->default('');
            $table->string('reboque_prop_ie',14)->nullable()->default('');
            $table->string('reboque_prop_uf',2)->nullable()->default('RN');
            $table->integer('reboque_prop_tpprop')->nullable()->default(0);
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
        Schema::dropIfExists('manifesto_reboques');
    }
}
