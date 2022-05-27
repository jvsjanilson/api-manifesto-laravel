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

    public function enviar($id)
    {
        return $this->repository->enviar($id);
    }

    public function damdfe($id)
    {
       return $this->repository->damdfe($id);
    }

    public function encerrar($id)
    {
        return $this->repository->encerrar($id);
    }

    public function cancelar($id)
    {
        return $this->repository->cancelar($id);
    }
}
