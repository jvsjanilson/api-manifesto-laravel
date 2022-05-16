<?php

namespace Tests\Feature;

use App\Models\ManifestoRodoLacre;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ManifestoRodoLacreTest extends TestCase
{
/**
     * A basic feature test rodo lacre.
     *
     * @return void
     */
    public function test_post_manifesto_rodo_lacre()
    {
        $response = $this->post('/api/rodo-lacres',[
            'manifesto_id' => 1,
            'numero' => '0123456789'
        ]);

        $response->assertStatus(201);
    }

    public function test_delete_manifesto_rodo_lacre()
    {
        $model = ManifestoRodoLacre::where('manifesto_id', 1)
            ->where('numero', '0123456789')
            ->first();

        $response = $this->delete('/api/rodo-lacres/'. $model->id);
        $response->assertStatus(200);

    }
}
