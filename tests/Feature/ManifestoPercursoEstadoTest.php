<?php

namespace Tests\Feature;

use App\Models\ManifestoPercursoEstado;
use Tests\TestCase;

class ManifestoPercursoEstadoTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_post_manifesto_percurso_estado()
    {
        $response = $this->post('/api/percurso-estados',[
            'manifesto_id' => 1,
            'estado_id' => 12,
        ]);

        $response->assertStatus(201);
    }

    public function test_delete_manifesto_percurso_estado()
    {
        $model = ManifestoPercursoEstado::where('manifesto_id', 1)
            ->where('estado_id', 12)
            ->first();

        $response = $this->delete('/api/percurso-estados/'. $model->id);
        $response->assertStatus(200);

    }
}
