<?php

namespace App\Http\Controllers;

use App\Models\Municipio;
use Illuminate\Http\Request;

class MunicipioController extends Controller
{
    private $model;


    public function __construct(Municipio $model)
    {
        $this->model = $model;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $regs = $this->model->select('id', 'nome', 'estado_id', 'capital', 'cod_ibge')
            ->paginate(config('app.paginate_number'));
        return response()->json($regs);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->only('nome', 'estado_id', 'capital', 'cod_ibge');
        try {
            $res = $this->model->create($data);
            return response()->json(['id'=> $res->id],201);
        } catch (\Exception $e) {
            return response()->json(
                [
                    'code' => $e->getCode(),
                    'msg'=> $e->getMessage()
                ]
                ,500
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
        try {
            $reg = $this->model->find($id);
            return response()->json($reg, 200);

        } catch (\Exception $e) {
            return response()->json(
                [
                    'code' => $e->getCode(),
                    'msg'=> $e->getMessage()
                ]
                ,500
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
        $inputs = $request->only('nome', 'capital', 'estado_id', 'cod_ibge');

        try {
            $reg = $this->model->find($id);
            $reg->update($inputs);
            return response()->json(['msg' => 'Atualizado com sucesso.']);
        } catch (\Exception $e) {
            return response()->json(
                [
                    'code' => $e->getCode(),
                    'msg'=> $e->getMessage()
                ]
                ,500
            );
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $reg = $this->model->find($id);
            $reg->delete();
        } catch (\Exception $e) {
            return response()->json(
                [
                    'code' => $e->getCode(),
                    'msg'=> $e->getMessage()
                ]
                ,500
            );
        }
    }
}
