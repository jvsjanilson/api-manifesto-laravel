<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateManifestoPedagiosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('manifesto_pedagios', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('manifesto_id');
            $table->foreign('manifesto_id')
                ->references('id')
                ->on('manifestos')
                ->onDelete('cascade');

            $table->string('cnpj_fornecedor',14)->nullable()->default('');
            $table->string('cpfcnpj_responsavel',14)->nullable()->default('');
            $table->integer('numero_comprovante')->nullable();
            $table->decimal('valor_vale', 13,2)->nullable()->default(0);
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
        Schema::dropIfExists('manifesto_pedagios');
    }
}
