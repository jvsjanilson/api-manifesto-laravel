<?php

namespace Tests\Feature;

use App\Models\ManifestoProdutoPredominante;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ManifestoProdutoPredominanteTest extends TestCase
{
   /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_post_produto_predominante()
    {
        $response = $this->post('/api/produtopredominantes',[
            'manifesto_id' => 1,
            'xprod' => 'Batata frita',
            'tpcarga' => '01'

        ]);
        $response->assertStatus(201);
    }

    public function test_destroy_produto_predominante()
    {
        $model = ManifestoProdutoPredominante::where('manifesto_id', 1)
            ->where('xprod', 'Batata frita')->first();

        $response = $this->delete('/api/produtopredominantes/'.$model->id);
        $response->assertStatus(200);
    }
}
