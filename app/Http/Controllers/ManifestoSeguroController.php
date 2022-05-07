<?php

namespace App\Http\Controllers;

use App\Models\Funcoes;
use App\Models\ManifestoSeguro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class ManifestoSeguroController extends Controller
{


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $fieldValidation = [
            'manifesto_id' => 'required',
            'resp_seg' => 'required',
        ];

        if ( strval( $request->resp_seg) == 2)
        {
            $fieldValidation = [
                'manifesto_id' => 'required',
                'resp_seg' => 'required',
                'cpfcnpj' => 'required',
                'nome_seguradora' => 'required',
                'cnpj_seguradora' => 'required',
                'numero_apolice' => 'required',
            ];
        }

        $validationData = Validator::make($request->all(), $fieldValidation);

        if ($validationData->fails()) {
            return response()->json([
                'inserted' => false,
                'msg' => 'Erro de validação',
                'errors' =>  $validationData->errors()
            ], Response::HTTP_BAD_REQUEST);
        }

        $data = $request->only('manifesto_id', 'resp_seg', 'cpfcnpj','nome_seguradora',
        'cnpj_seguradora','numero_apolice');

        if (!isset($data['numero_apolice'])) {
            $data['numero_apolice'] = '';
        }
        if (!isset($data['cpfcnpj'])) {
            $data['cpfcnpj'] = '';
        }
        //DB::enableQueryLog();
        $find = ManifestoSeguro::
            where('manifesto_id', $data['manifesto_id'])
            ->where('numero_apolice', $data['numero_apolice'])
            ->where('cpfcnpj', Funcoes::disFormatCPFCNPJ($data['cpfcnpj']))
            ->first();
        //dd(DB::getQueryLog());

        if (isset($find)) {
            return response()->json(
                [
                    'msg' => 'Número apolice já lançado.'
                ],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }

        try {

            $create = ManifestoSeguro::create($data);
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
        $reg = ManifestoSeguro::find($id);

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
