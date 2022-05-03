<?php

namespace App\Http\Controllers;

use App\Models\Funcoes;
use App\Models\ManifestoAutorizacao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class ManifestoAutorizacaoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->only('manifesto_id', 'cpfcnpj');
        $data['cpfcnpj'] = Funcoes::disFormatCPFCNPJ($data['cpfcnpj']);

        $find = ManifestoAutorizacao::where('cpfcnpj', $data['cpfcnpj'])
            ->where('manifesto_id', $data['manifesto_id'])
            ->first();

        if (isset($find)) {
            return response()->json(
                [
                    'msg' => 'CPF/CNPJ já lançado'
                ],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }


        $count = ManifestoAutorizacao::select(DB::raw('count(*) as total'))
            ->where('manifesto_id', $data['manifesto_id'])
            ->get()[0]['total'];

        if ($count >= 10)
        {
            return response()->json(
                [
                    'msg' => 'Número máximo é 10.'
                ],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }

        $create = ManifestoAutorizacao::create($data);

        if (isset($create)) {
            return response()->json(
                [
                    'inserted' => true,
                    'data' => $create
                ],
                Response::HTTP_CREATED
            );
        } else {
            return response()->json(
                [
                    'inserted' => false,
                    'msg' => 'Error ao inserir'
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
        $reg = ManifestoAutorizacao::find($id);

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
                    'msg'=> $e->getMessage(),
                    'deleted' => false
                ],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }
}
