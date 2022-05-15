<?php

namespace App\Repositories;

use App\Models\Manifesto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Symfony\Component\HttpFoundation\Response;

class ManifestoRepository extends Repository
{
    public function __construct(Manifesto $model)
    {
        parent::__construct($model);
    }
    // {
    //     "datahora": "2022-05-13",
    //     "ufini": "RN",
    //     "uffim": "PB",
    //     "tipoemit": 1,
    //     "tipotransp": 1,
    //     "modal": 1,
    //     "cunid": "01",
    //     "valor_carga": 1.25,
    //     "quant_carga": 100,
    //     "infofisco": "Info Fisco",
    //     "infocompl": "Info Complemento"
    // }
    public function store(Request $request)
    {
        $manifesto = $request->all();



        // $veiculo_tracao = $request->only('vtracao_rntrc','vtracao_cint','vtracao_tpcar','vtracao_placa',
        //     'vtracao_tara','vtracao_renavam','vtracao_tprod','vtracao_capkg','vtracao_capm3','vtracao_uf',
        //     'vtracao_prop','vtracao_prop_tpprop','vtracao_prop_uf','vtracao_prop_nome','vtracao_prop_cpfcnpj',
        //     'vtracao_prop_ie', 'vtracao_prop_rntrc'
        // );

        // $ufs_carregamento = $request->only('ufs-carregamento');
        // $municipios_carregamento = $request->only('muninicipos-carregamento');
        // $uf_percursos = $request->only('uf-percursos');
        // $lacres = $request->only('lacres');
        // $autorizacao_download = $request->only('autorizacao-download');
        // $seguros_resp_seg = $request->only('seguros');
        // $mun_descarregamento_uf = $request->only('municipio-descarregamento');
        // $nfes_municipio = $request->only('nfes-municipio');
        // $ctes_municipio = $request->only('ctes-municipio');



         $condutores = $request->only('contratantes');

         // $rodolacres = $request->only('rodo-lacre');
         // $contratantes = $request->only('contratantes');
         // $ciots = $request->only('ciots');
         // $pedagios = $request->only('pedagios');
         // $reboques = $request->only('reboques');




         // $prodPred = $request->only('tpcarga','cean','ncm','xprod');

         return response()->json($manifesto);



    }
}
