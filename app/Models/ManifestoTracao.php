<?php

namespace App\Models;

use App\Observers\ManifestoTracaoObserver;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManifestoTracao extends Model
{
    use HasFactory;
    public $fillable = ['manifesto_id', 'vtracao_rntrc','vtracao_cint','vtracao_tpcar','vtracao_placa',
    'vtracao_tara','vtracao_renavam','vtracao_tprod','vtracao_capkg','vtracao_capm3','vtracao_uf',
    'vtracao_prop','vtracao_prop_tpprop','vtracao_prop_uf','vtracao_prop_nome','vtracao_prop_cpfcnpj',
    'vtracao_prop_ie', 'vtracao_prop_rntrc'];


    public static function boot()
    {
        parent::boot();
        static::observe(new ManifestoTracaoObserver);
    }

    public function setVtracaoPropCpfcnpjAttribute($value)
    {
        $this->attributes['vtracao_prop_cpfcnpj'] = Funcoes::disFormatCPFCNPJ($value);
    }

    public function getVtracaoPropCpfcnpjAttribute($value)
    {
        return Funcoes::FormatCPFCNPJ($value);
    }
}
