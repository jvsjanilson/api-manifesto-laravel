<?php

namespace Tests\Feature;

use App\Models\ManifestoCiot;
use Tests\TestCase;

use function PHPSTORM_META\type;

class ManifestoCiotTest extends TestCase
{

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_post_ciot()
    {
        $response = $this->post('/api/ciots',[
            'manifesto_id' => 1,
            'ciot' => '012345678912',
            'cpfcnpj' => '29140433846'
        ]);
        $response->assertStatus(201);
    }

    public function test_destroy_ciot()
    {
        $model = ManifestoCiot::where('manifesto_id', 1)
            ->where('ciot', '012345678912')->first();

        $response = $this->delete('/api/ciots/'.$model->id);
        $response->assertStatus(200);
    }
}
