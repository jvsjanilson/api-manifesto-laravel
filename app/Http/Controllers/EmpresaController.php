<?php

namespace App\Http\Controllers;


use App\Repositories\EmpresaRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class EmpresaController extends Controller
{

    private $repository;

    public function __construct(EmpresaRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        return $this->repository->index();
    }

    public function store(Request $request)
    {
        $validationData = Validator::make($request->all(),
            [
                'nome' => 'required',
                'cnpj' => 'required',
            ],
            [
                'required' => 'O :attribute é obrigatório',
            ],
            [
                'nome' => 'Nome',
                'cnpj' => 'CNPJ'
            ]
        );

        if ($validationData->fails()) {
            return response()->json([
                'inserted' => false,
                'msg' => 'Erro de validação',
                'errors' =>  $validationData->errors()
            ], Response::HTTP_BAD_REQUEST);
        }

        return $this->repository->store($request);
    }

    public function update(Request $request, $id)
    {
        return $this->repository->update($request, $id);
    }

    public function destroy($id)
    {
        return $this->repository->destroy($id);
    }
}
