<?php

namespace Tests\Feature;

use App\Models\ManifestoReboque;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ManifestoReboqueTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_post_manifesto_reboque()
    {
        $response = $this->post('/api/reboques',[
            'manifesto_id' => 1,
            'reboque_prop' => 0,
            'reboque_placa' => 'MLD4125',
            'reboque_tara' => 1000,
            'reboque_capkg' => 10000,
        ]);

        $response->assertStatus(201);
    }

    public function test_delete_manifesto_reboque()
    {
        $model = ManifestoReboque::where('manifesto_id', 1)
            ->first();

        $response = $this->delete('/api/reboques/'. $model->id);
        $response->assertStatus(200);

    }

}
