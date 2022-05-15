<?php

namespace Tests\Feature;

use App\Models\ManifestoLacre;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ManifestoLacreTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_post_manifesto_lacre()
    {
        $response = $this->post('/api/lacres',[
            'manifesto_id' => 1,
            'numero' => '12345678'
        ]);

        $response->assertStatus(201);
    }

    public function test_delete_manifesto_lacre()
    {
        $model = ManifestoLacre::where('manifesto_id', 1)
            ->where('numero', '12345678')
            ->first();

        $response = $this->delete('/api/lacres/'. $model->id);
        $response->assertStatus(200);

    }

}
