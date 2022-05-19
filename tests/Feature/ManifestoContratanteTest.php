<?php

namespace Tests\Feature;

use App\Models\ManifestoContratante;
use Tests\TestCase;

class ManifestoContratanteTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_post_manifesto_contratante()
    {
        $response = $this->post('/api/contratantes',[
            'manifesto_id' => 1,
            'cpfcnpj' => '29140433846'
        ]);

        $response->assertStatus(201);
    }

    /**
     * Destroy Contratante
     */
    public function test_delete_manifesto_contratante()
    {
        $model = ManifestoContratante::where('manifesto_id', 1)
            ->where('cpfcnpj', '29140433846')
            ->first();

        $response = $this->delete('/api/contratantes/'. $model->id);
        $response->assertStatus(200);
    }

    /**
     * Validation required Cpfcnpj
     */
    public function test_post_manifesto_contratante_required_cpfcnpj()
    {
        $response = $this->post('/api/contratantes',[
            'manifesto_id' => 1,
        ]);
        $response->assertStatus(422);
    }

    /**
     * Validation duplicidade
     */
    public function test_post_manifesto_contratante_duplicidade()
    {
        for ($i = 0; $i <= 1; $i++)
        {
            $response = $this->post('/api/contratantes',[
                'manifesto_id' => 1,
                'cpfcnpj' => '29140433846'
            ]);
        }

        $response->assertStatus(422);

        ManifestoContratante::where('manifesto_id', 1)
            ->delete();
    }


}
