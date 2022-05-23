<?php

namespace Tests\Feature;

use App\Models\Manifesto;
use Tests\TestCase;

class ManifestoDestroyTest extends TestCase
{
    /**
     * A basic feature test destroy manifesto.
     *
     * @return void
     */
   public function test_destroy_manifesto()
    {
        $model = Manifesto::first();
        $response = $this->delete('/api/manifestos/'.$model->id);
        $response->assertStatus(200);

    }
}
