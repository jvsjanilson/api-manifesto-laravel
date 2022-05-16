<?php

namespace Tests\Feature;

use App\Models\ManifestoCondutor;
use Tests\TestCase;

class ManifestoCondutorTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_post_manifesto_condutor()
    {
        $response = $this->post('/api/condutors',[
            'manifesto_id' => 1,
            'nome' => 'Janilson Varela de Souza',
            'cpf' => '29140433846'
        ]);
        //dd($response);
        $response->assertStatus(201);
    }

    public function test_destroy_manifesto_condutor()
    {
        $model = ManifestoCondutor::where('manifesto_id', 1)
            ->where('cpf', '29140433846')->first();

        $response = $this->delete('/api/condutors/'.$model->id);
        $response->assertStatus(200);
    }

}
