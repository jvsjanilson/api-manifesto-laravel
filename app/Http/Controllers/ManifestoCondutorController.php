<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\CondutorRepository;

class ManifestoCondutorController extends Controller
{

    private $repository;

    public function __construct(CondutorRepository $repository)
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
