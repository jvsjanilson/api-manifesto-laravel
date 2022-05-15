<?php

namespace Tests\Feature;

use App\Models\ManifestoCte;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ManifestoCteTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_post_manifesto_cte()
    {
        $response = $this->post('/api/ctes',[
            'manifesto_id' => 1,
            'municipio_id' => 1161,
            'chave' => '24232569982423256998242325699824232569981234',

        ]);

        $response->assertStatus(201);
    }

    public function test_delete_manifesto_cte()
    {
        $model = ManifestoCte::where('manifesto_id', 1)
            ->where('municipio_id', 1161)
            ->where('chave', '24232569982423256998242325699824232569981234')
            ->first();

        $response = $this->delete('/api/ctes/'. $model->id);
        $response->assertStatus(200);

    }
}
