<?php

namespace Tests\Feature;

use App\Models\ManifestoMunicipioCarregamento;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ManifestoMunicipioCarregamentoTest extends TestCase
{
/**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_post_manifesto_municipio_carregamento()
    {
        $response = $this->post('/api/municipio-carregamentos',[
            'manifesto_id' => 1,
            'estado_id' => 12,
            'municipio_id' => 1161,


        ]);

        $response->assertStatus(201);
    }

    public function test_delete_manifesto_municipio_carregamento()
    {
        $model = ManifestoMunicipioCarregamento::where('manifesto_id', 1)
            ->where('estado_id', 12)
            ->where('municipio_id', 1161)
            ->first();

        $response = $this->delete('/api/municipio-carregamentos/'. $model->id);
        $response->assertStatus(200);

    }
}
