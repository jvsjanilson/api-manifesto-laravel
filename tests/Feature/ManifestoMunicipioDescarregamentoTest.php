<?php

namespace Tests\Feature;

use App\Models\ManifestoMunicipioDescarregamento;
use Tests\TestCase;

class ManifestoMunicipioDescarregamentoTest extends TestCase
{
    /**
     * A basic feature test post.
     *
     * @return void
     */
    public function test_post_manifesto_municipio_descarregamento()
    {
        $response = $this->post('/api/municipio-descarregamentos',[
            'manifesto_id' => 1,
            'estado_id' => 12,
            'municipio_id' => 1161,
        ]);

        $response->assertStatus(201);
    }

    public function test_delete_manifesto_municipio_descarregamento()
    {
        $model = ManifestoMunicipioDescarregamento::where('manifesto_id', 1)
            ->where('estado_id', 12)
            ->where('municipio_id', 1161)
            ->first();

        $response = $this->delete('/api/municipio-descarregamentos/'. $model->id);
        $response->assertStatus(200);

    }
}
