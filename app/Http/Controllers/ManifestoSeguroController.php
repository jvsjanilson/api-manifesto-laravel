<?php

namespace App\Http\Controllers;

use App\Http\Requests\SeguroStoreFormRequest;
use App\Repositories\SeguroRepository;
use Illuminate\Http\Request;


class ManifestoSeguroController extends Controller
{
    private $repository;

    public function __construct(SeguroRepository $repository)
    {
        $this->repository = $repository;
    }


    public function store(SeguroStoreFormRequest $request)
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
