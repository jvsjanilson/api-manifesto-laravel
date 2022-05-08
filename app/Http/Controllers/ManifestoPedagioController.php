<?php

namespace App\Http\Controllers;

use App\Models\Funcoes;
use App\Models\ManifestoPedagio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class ManifestoPedagioController extends Controller
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
            'numero_comprovante' => 'required|integer',
            'cnpj_fornecedor' => 'required',
            'manifesto_id' => 'required'
        ]);

        if ($validationData->fails()) {
            return response()->json([
                'inserted' => false,
                'msg' => 'Erro de validação',
                'errors' =>  $validationData->errors()
            ], Response::HTTP_BAD_REQUEST);
        }

        $data = $request->only('manifesto_id', 'cnpj_fornecedor', 'numero_comprovante',
            'cpfcnpj_responsavel','valor_vale');

        //$data['cpfcnpj'] = $data['cpfcnpj'];

        $find = ManifestoPedagio::where('manifesto_id', $data['manifesto_id'])
            ->where('cnpj_fornecedor', Funcoes::disFormatCPFCNPJ($data['cnpj_fornecedor']))
            ->where('numero_comprovante', $data['numero_comprovante'])
            ->first();

        if (isset($find)) {
            return response()->json(
                [
                    'msg' => 'Registro já lançado'
                ],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }


        try {
            $create = ManifestoPedagio::create($data);
            return response()->json(
                [
                    'inserted' => true,
                    'data' => $create
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
        $reg = ManifestoPedagio::find($id);

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