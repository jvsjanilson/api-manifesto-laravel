<?php

namespace Tests\Feature;

use App\Models\ManifestoPedagio;
use Tests\TestCase;

class ManifestoPedagioTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_post_manifesto_pedagio()
    {
        $response = $this->post('/api/pedagios',[
            'manifesto_id' => 1,
            'cnpj_fornecedor' => '41003278000108',
            'cpfcnpj_responsavel' => '29140433846',
            'numero_comprovante' => 123456,
            'valor_vale' => 101.01,


        ]);

        $response->assertStatus(201);
    }

    public function test_delete_manifesto_pedagio()
    {
        $model = ManifestoPedagio::where('manifesto_id', 1)
            ->where('numero_comprovante', 123456)
            ->where('cnpj_fornecedor', '41003278000108')
            ->first();

        $response = $this->delete('/api/pedagios/'. $model->id);
        $response->assertStatus(200);

    }
}
