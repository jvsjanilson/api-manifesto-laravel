<?php


namespace App\Repositories;

use App\Models\ManifestoMunicipioDescarregamento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;
use App\Constantes\Limite;

class MunicipioDescarregamentoRepository extends Repository
{
    public function __construct(ManifestoMunicipioDescarregamento $model)
    {
        parent::__construct($model);
    }

    public function store(Request $request)
    {
        $validationData = Validator::make($request->all(), [
            'estado_id' => 'required',
            'municipio_id' => 'required',
            'manifesto_id' => 'required'
        ]);

        if ($validationData->fails()) {
            return response()->json([
                'created' => false,
                'msg' => 'Erro de validação',
                'errors' =>  $validationData->errors()
            ], Response::HTTP_BAD_REQUEST);
        }

        $data = $request->only('manifesto_id', 'estado_id', 'municipio_id');

        $find = $this->model->where('manifesto_id', $data['manifesto_id'])
            ->where('estado_id', $data['estado_id'])
            ->where('municipio_id', $data['municipio_id'])
            ->first();

        if (isset($find)) {
            return response()->json(
                [
                    'msg' => 'Município já lançado'
                ],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }


        $count = $this->model->select(DB::raw('count(*) as total'))
            ->where('manifesto_id', $data['manifesto_id'])
            ->get()[0]['total'];

        if ($count >= Limite::NUMERO_MAXIMO_MUNICIPIO_DESCARREGAMENTO)
        {
            return response()->json(
                [
                    'msg' => 'Número máximo é ' . strval(Limite::NUMERO_MAXIMO_MUNICIPIO_DESCARREGAMENTO) . '.'
                ],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }

        try {
            $create = $this->model->create($data);
            return response()->json(
                [
                    'created' => true,
                    'data' => $create
                ],
                Response::HTTP_CREATED
            );
        } catch (\Exception $e) {
            return response()->json(
                [
                    'created' => false,
                    'msg' => env('APP_DEBUG') == true ? 'Error ao inserir: ' . $e->getMessage() : 'Error ao inserir'
                ],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }

}
