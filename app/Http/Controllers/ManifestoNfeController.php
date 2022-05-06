<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

use App\Models\ManifestoNfe;
use App\Constantes\Limite;
use Illuminate\Support\Facades\DB;

class ManifestoNfeController extends Controller
{


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validationData = Validator::make($request->all(), [
            'chave' => 'required',
            'municipio_id' => 'required',
            'manifesto_id' => 'required'
        ]);

        if ($validationData->fails()) {
            return response()->json([
                'inserted' => false,
                'msg' => 'Erro de validação',
                'errors' =>  $validationData->errors()
            ], Response::HTTP_BAD_REQUEST);
        }

        $data = $request->only('manifesto_id', 'chave', 'municipio_id', 'segcodbarras');

        $find = ManifestoNfe::where('chave', $data['chave'])
            ->where('manifesto_id', $data['manifesto_id'])
            ->first();

        if (isset($find)) {
            return response()->json(
                [
                    'msg' => 'Chave já lançado'
                ],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }


        $count = ManifestoNfe::select(DB::raw('count(*) as total'))
            ->where('manifesto_id', $data['manifesto_id'])
            ->get()[0]['total'];

        if ($count >= Limite::NUMERO_MAXIMO_CTE)
        {
            return response()->json(
                [
                    'msg' => 'Número máximo é ' . strval(Limite::NUMERO_MAXIMO_CTE). '.'
                ],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }

        try {
            $create = ManifestoNfe::create($data);
            return response()->json(
                [
                    'inserted' => true,
                    'data' => ManifestoNfe::select('manifesto_nfes.id', 'manifesto_nfes.chave',
                        'manifesto_nfes.segcodbarras',
                        'municipios.nome'
                    )
                    ->join('municipios', 'manifesto_nfes.municipio_id', '=', 'municipios.id')
                    ->find($create->id)
                ],
                Response::HTTP_CREATED
            );
        } catch (\Exception $e) {
            return response()->json(
                [
                    'inserted' => false,
                    'msg' => env('APP_DEBUG') == true ? 'Error ao inserir: ' . $e->getMessage() : 'Error ao inserir'
                ],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $reg = ManifestoNfe::find($id);

        if ( !isset($reg)) {
            return response()->json(
                [
                    'msg'=> 'Registro não encontrado.',
                    'deleted' => false
                ],
                Response::HTTP_NOT_FOUND
            );
        }

        try {
            $reg->delete();
            return response()->json(
                    [
                        'msg'=> 'Removido com sucesso.',
                        'deleted' => true
                    ],
                    Response::HTTP_OK
                );
        } catch (\Exception $e) {
            return response()->json(
                [
                    'msg'=> env('APP_DEBUG') == true ? 'Error ao deletar: ' . $e->getMessage() : 'Error ao deletar',
                    'deleted' => false
                ],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }
}