<?php

namespace Tests\Feature;

use App\Models\ManifestoSeguro;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ManifestoSeguroTest extends TestCase
{
/**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_post_manifesto_seguro()
    {
        $response = $this->post('/api/seguros',[
            'manifesto_id' => 1,
            'resp_seg' => 1,
            'cpfcnpj' => '29140433846',
            'nome_seguradora' => 'Porto Seguro S/A',
            'cnpj_seguradora' => '41003278000108',
            'numero_apolice' => '101010',
        ]);

        $response->assertStatus(201);
    }

    public function test_destroy_manifesto_seguro()
    {
        $model = ManifestoSeguro::where('manifesto_id', 1)
            ->where('cpfcnpj', '29140433846')
            ->where('cnpj_seguradora', '41003278000108')
            ->where('numero_apolice', '101010')
            ->first();

        $response = $this->delete('/api/seguros/'.$model->id);
        $response->assertStatus(200);
    }
}
