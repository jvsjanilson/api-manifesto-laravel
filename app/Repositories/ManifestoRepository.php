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

    public function show($id)
    {
        try {
            $reg = $this->model->with([
                    'condutors',
                    'seguros',
                    'rodoLacres',
                    'reboques',
                    'produtoPredominante',
                    'percuroEstados',
                    'pedagios',
                    'nfes',
                    'municipiosDescarregamento',
                    'municipiosCarregamento',
                    'lacres',
                    'ctes',
                    'autorizacaos',
                    'ciots',
                    'contratantes'
                ])->find($id);

            if (!isset($reg)) {
                return response()->json(['message'=> 'Registro não encontrado'], Response::HTTP_NOT_FOUND);
            }

            return response()->json($reg, Response::HTTP_OK);

        } catch (\Exception $e) {
            return response()->json(
                [
                    'code' => $e->getCode(),
                    'message'=> $e->getMessage()
                ]
                ,Response::HTTP_BAD_REQUEST
            );
        }
    }


    public function store(Request $request)
    {
        $manifesto = $request->all();
        Validation::validacoes($request);

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

            return response()->json($created,Response::HTTP_CREATED);
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), Response::HTTP_BAD_REQUEST);
        }
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
