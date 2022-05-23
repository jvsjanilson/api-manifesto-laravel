<?php

namespace App\Repositories;


use App\Models\Manifesto;
use App\Validations\Validation;
use Illuminate\Http\Request;

use Symfony\Component\HttpFoundation\Response;

class ManifestoRepository extends Repository
{
    public function __construct(Manifesto $model)
    {
        parent::__construct($model);
    }

    public function store(Request $request)
    {
        $manifesto = $request->all();
        Validation::validacoes($request);
      //  dd($manifesto['veiculo_tracao']);


        try {
            $created = Manifesto::create($manifesto);
            $created->condutors()->createMany($manifesto['condutores']);
            $created->contratantes()->createMany($manifesto['contratantes']);
            $created->ciots()->createMany($manifesto['ciots']);
            $created->autorizacaos()->createMany($manifesto['autorizacaos']);
            $created->ctes()->createMany($manifesto['ctes']);
            $created->lacres()->createMany($manifesto['lacres']);
            $created->municipiosCarregamento()->createMany($manifesto['municipios_carregamento']);
            $created->municipiosDescarregamento()->createMany($manifesto['municipios_descarregamento']);
            $created->nfes()->createMany($manifesto['nfes']);
            $created->pedagios()->createMany($manifesto['pedagios']);
            $created->percuroEstados()->createMany($manifesto['percuro_estados']);
            $created->produtoPredominante()->createMany($manifesto['produto_predominante']);
            $created->reboques()->createMany($manifesto['reboques']);
            $created->rodoLacres()->createMany($manifesto['rodo_lacres']);
            $created->seguros()->createMany($manifesto['seguros']);
            $created->veiculoTracao()->create($manifesto['veiculo_tracao']);


            return response()->json($created,201);
        } catch (\Throwable $th) {
            return response()->json($th->getMessage());
        }
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


         // $rodolacres = $request->only('rodo-lacre');
         // $contratantes = $request->only('contratantes');
         // $ciots = $request->only('ciots');
         // $pedagios = $request->only('pedagios');
         // $reboques = $request->only('reboques');




         // $prodPred = $request->only('tpcarga','cean','ncm','xprod');

         return response()->json($manifesto);



    }

    public function destroy($id)
    {
        $reg = $this->model->find($id);

        if ( !isset($reg)) {
            return response()->json(
                [
                    'message'=> 'Registro não encontrado.',
                ],
                Response::HTTP_NOT_FOUND
            );
        }

        if ($reg->situacao != 1)
        {
            return response()->json(
                ['message'=> 'Remoção não permitida'],
                Response::HTTP_UNPROCESSABLE_ENTITY
            );
        }

        try {
            $reg->delete();
            return response()->json(
                    [
                        'message'=> 'Removido com sucesso.',
                    ],
                    Response::HTTP_OK
                );
        } catch (\Exception $e) {
            return response()->json(
                [
                    'message'=> env('APP_DEBUG') == true ? 'Error ao deletar: ' . $e->getMessage() : 'Error ao deletar',

                ],
                Response::HTTP_BAD_REQUEST
            );
        }
    }
}
