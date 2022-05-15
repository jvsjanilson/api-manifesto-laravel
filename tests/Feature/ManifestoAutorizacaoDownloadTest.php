<?php

namespace Tests\Feature;

use App\Models\ManifestoAutorizacao;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ManifestoAutorizacaoDownloadTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_post_autorizacao_download()
    {
        $response = $this->post('/api/autorizacaos',[
            'manifesto_id' => 1,
            'cpfcnpj' => '29140433846'
        ]);

        $response->assertStatus(201);
    }

    public function test_delete_autorizacao_download()
    {
        $model = ManifestoAutorizacao::where('manifesto_id', 1)
            ->where('cpfcnpj', '29140433846')
            ->first();

        $response = $this->delete('/api/autorizacaos/'.$model->id);
        $response->assertStatus(200);
    }

    // public function test_post_greater_than_ten_autorizacao_download()
    // {
    //     for ($i = 1; $i<=11; $i++) {
    //         $response = $this->post('/api/autorizacaos',[
    //             'manifesto_id' => 1,
    //             'cpfcnpj' => str_pad( strval(  rand(1,99999999999)),11, "0")
    //         ]);
    //     }
    //     $response->assertStatus(500);
    // }

    // public function test_destroy_all_autorizacao_download()
    // {
    //     $model = ManifestoAutorizacao::where('manifesto_id',1)->get();

    //     foreach ($model as $autorizacao) {
    //         $response = $this->delete('/api/autorizacaos/'.$autorizacao->id);
    //     }

    //     $response->assertStatus(200);
    // }
}
