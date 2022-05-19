<?php

namespace Tests\Feature;

use App\Models\ManifestoSeguroAverbacao;
use App\Models\ManifestoSeguro;
use Tests\TestCase;

class ManifestoSeguroAverbacaoTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_post_manifesto_seguro_averbacao()
    {

        $seguro = ManifestoSeguro::create([
            'manifesto_id' => 1,
            'resp_seg' => 1,
            'cpfcnpj' => '29140433846',
            'nome_seguradora' => 'Porto Seguro S/A',
            'cnpj_seguradora' => '41003278000108',
            'numero_apolice' => '101010',
        ]);

        $response = $this->post('/api/seguro-averbacaos',[
            'manifesto_id' => 1,
            'manifesto_seguro_id' => $seguro->id,
            'numero' => '12345678'
        ]);

        $response->assertStatus(201);
    }

    public function test_delete_manifesto_seguro_averbacao()
    {
        $seguro = ManifestoSeguro::where('manifesto_id', 1)
            ->where('cpfcnpj', '29140433846')
            ->where('cnpj_seguradora', '41003278000108')
            ->where('numero_apolice', '101010')
            ->first();

        $model = ManifestoSeguroAverbacao::where('manifesto_id', 1)
            ->where('numero', '12345678')
            ->where('manifesto_seguro_id', $seguro->id)
            ->first();

        $response = $this->delete('/api/seguro-averbacaos/'. $model->id);

        $seguro->delete();
        $response->assertStatus(200);

    }
}
