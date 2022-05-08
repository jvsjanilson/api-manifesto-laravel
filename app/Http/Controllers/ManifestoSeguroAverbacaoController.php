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

    /**
     * Display a listing of the resource.
     * @param  int  $manifeto_id
     * @param  int  $seguro_id
     * @return \Illuminate\Http\Response
     */
    public function list($manifesto_id, $seguro_id)
    {
        return $this->repository->list($manifesto_id, $seguro_id);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $this->repository->store($request);

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

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->repository->destroy($id);
    }
}
