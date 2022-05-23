<?php

namespace Tests\Feature;

use App\Models\ManifestoNfe;
use Tests\TestCase;

class ManifestoNfeTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_post_manifesto_nfe()
    {
        $response = $this->post('/api/nfes',[
            'manifesto_id' => 1,
            'municipio_id' => 1161,
            'chave' => '24232569982423256998242325699824232569981234',


        ]);

        $response->assertStatus(201);
    }

    public function test_delete_manifesto_nfe()
    {
        $model = ManifestoNfe::where('manifesto_id', 1)
            ->where('municipio_id', 1161)
            ->where('chave', '24232569982423256998242325699824232569981234')
            ->first();

        $response = $this->delete('/api/nfes/'. $model->id);
        $response->assertStatus(200);

    }
}
