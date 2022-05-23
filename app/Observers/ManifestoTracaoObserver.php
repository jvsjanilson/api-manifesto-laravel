<?php

namespace App\Observers;
use Illuminate\Database\Eloquent\Model;

class ManifestoTracaoObserver
{
    public function creating(Model $model)
    {
        if (isset(request()->request->get('veiculo_tracao')['vtracao_prop']))
        {
            if (request()->request->get('veiculo_tracao')['vtracao_prop'] == 0)
            {
                $model->setAttribute('vtracao_prop_nome','');
                $model->setAttribute('vtracao_prop_cpfcnpj','');
                $model->setAttribute('vtracao_prop_tpprop',0);
            }
        }
    }
}
