<?php

namespace App\Observers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class ManifestoObserver
{
    public function creating(Model $model)
    {
        // dd('ola');
        //dd(request());
         //dd(session()->get('empresa_logada'));
     //   dd(auth()->user()->empresas);
        // if (auth()->user()->id != 1)
          //   $model->setAttribute('empresa_id', 1);
    }
}
