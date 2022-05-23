<?php

namespace Tests\Feature;

use App\Models\Manifesto;
use App\Models\ManifestoProdutoPredominante;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class ManifestoTest extends TestCase
{
    /**
     * A basic feature test post manifesto.
     *
     * @return void
     */
    public function test_post_manifesto()
    {
        //Artisan::command('migrate:fresh --seed');
        Artisan::call('migrate:fresh', ['--seed' => 'default']);

        $response = $this->post('/api/manifestos',[

                "empresa_id"=> 1,
                "datahora" => "2022-05-23",
                "ufini" => "RN",
                "uffim" => "PB",
                "tipoemit" => 1,
                "tipotransp" => 1,
                "modal" => 1,
                "cunid" => "02",
                "valor_carga" => 1.25,
                "quant_carga" => 100,
                "infofisco" => "Info Fisco",
                "infocompl" => "Info Complemento",
                "situacao" => 1,
                "veiculo_tracao" => [
                    "vtracao_placa" => "MKF2D50",
                    "vtracao_tara" => 1000,
                    "vtracao_tprod" => 1,
                    "vtracao_tpcar" => 1,
                    "vtracao_uf" => "RN",
                    "vtracao_prop" => 1,
                    "vtracao_prop_nome" => "Janilson",
                    "vtracao_prop_cpfcnpj" => "29140433846",
                    "vtracao_prop_uf" => "RN",
                    "vtracao_prop_tpprop" => 1
                ],

                "condutores" => [
                    [
                        "cpf" => "99999999999",
                        "nome" => "Janilson"
                    ],
                    [
                        "cpf" => "88888888888",
                        "nome" => "Regia Fabiana"
                    ]
                ],

                "contratantes" => [
                    [
                        "cpfcnpj" => "41003278000108"
                    ]
                ],

                "ciots" => [
                    [
                        "ciot" => "999",
                        "cpfcnpj" => "41003278000108"
                    ]
                ],

                //

                "rodo_lacres" => [
                    [
                        "numero" => "9999"
                    ]
                ],
                "reboques" => [
                    [
                        "reboque_prop" => 0,
                        "reboque_tara" => 1000,
                        "reboque_capkg" => 15000,
                        "reboque_placa" => "PMM6B60"
                    ]
                ],
                "produto_predominante" => [
                    [
                        "tpcarga" => "01",
                        "xprod" => "Bobina"
                    ]
                ],
                "percuro_estados"=> [
                    [
                        "estado_id" => 11
                    ]
                ],
                "pedagios" => [
                    [
                        "cnpj_fornecedor" => "41003278000108",
                        "numero_comprovante" => 10
                    ]
                ],
                "nfes" => [
                    [
                        "municipio_id" => 1161,
                        "chave" => "24236254582423625458242362545824236254584556"
                    ]
                ],
                "municipios_descarregamento" => [
                    [
                        "estado_id" => 12,
                        "municipio_id" => 1162
                    ]
                ],
                "municipios_carregamento" => [
                    [
                        "estado_id" => 12,
                        "municipio_id" => 1162
                    ]
                ],
                "lacres" => [
                    [
                        "numero" => "2515"
                    ]
                ],
                "ctes" => [
                    [
                        "municipio_id" => 1162,
                        "chave" => "24362536362436253636243625363624362536361478"
                    ]
                ],
                "autorizacaos" => [
                    [
                        "cpfcnpj" => "41003278000108"
                    ]
                ],
                //


                "seguros" => [

                    [
                        "resp_seg" => 2,
                        "cpfcnpj" => "41003278000108",
                        "nome_seguradora" => "porto seguro",
                        "cnpj_seguradora" => "41003278000108",
                        "numero_apolice" => 1
                    ]
                ],


        ]);

        $response->assertStatus(201);
    }

    public function test_destroy_manifesto_produto_predominante()
    {
        $count = 0;
        $count = ManifestoProdutoPredominante::where('manifesto_id', '>',0)->delete();
        $this->assertGreaterThan(0,$count);


    }

    // public function test_destroy_manifesto()
    // {
    //     $model = Manifesto::first();
    //     $response = $this->delete('/api/manifestos/'.$model->id);
    //     $response->assertStatus(200);

    // }
}
