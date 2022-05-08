<?php

namespace App\Http\Controllers;

use App\Repositories\SeguroAverbacaoRepository;
use Illuminate\Http\Request;

class ManifestoSeguroAverbacaoController extends Controller
{

    private $repository;

    public function __construct(SeguroAverbacaoRepository $repository)
    {
        $this->repository = $repository;
    }

    public function list($manifesto_id, $seguro_id)
    {
        return $this->repository->list($manifesto_id, $seguro_id);
    }


    public function store(Request $request)
    {
        return $this->repository->store($request);
    }

    public function update(Request $request, $id)
    {

    }

    public function destroy($id)
    {
        return $this->repository->destroy($id);
    }
}
