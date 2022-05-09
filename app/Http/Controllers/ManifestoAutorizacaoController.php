<?php

namespace App\Http\Controllers;

use App\Repositories\AutorizacaoDownloadRepository;
use Illuminate\Http\Request;

class ManifestoAutorizacaoController extends Controller
{

    private $repository;

    public function __construct(AutorizacaoDownloadRepository $repository)
    {
        $this->repository = $repository;
    }

    public function store(Request $request)
    {
        return $this->repository->store($request);
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        return $this->repository->destroy($id);
    }
}
