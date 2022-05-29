<?php

namespace App\Http\Controllers;

use App\Repositories\MDFeRepository;


class MDFeController extends Controller
{
    private $repository;

    public function __construct(MDFeRepository $repository)
    {
        $this->repository = $repository;
    }

    public function statusServico($empresa)
    {
        //return 'ola';
        return $this->repository->statusServico($empresa);
    }

    public function envia($id)
    {
        return $this->repository->envia($id);
    }

    public function damdfe($id)
    {
       return $this->repository->damdfe($id);
    }

    public function encerra($id)
    {
        return $this->repository->encerra($id);
    }

    public function cancela($id)
    {
        return $this->repository->cancela($id);
    }
}
