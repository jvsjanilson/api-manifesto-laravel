<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManifestoReboque extends Model
{
    use HasFactory;
    public $fillable = [
        'manifesto_id',
        'reboque_placa',
        'reboque_renavam',
        'reboque_tara',
        'reboque_capkg',
        'reboque_capm3',
        'reboque_tpcar',
        'reboque_uf',
        'reboque_cod_agporto',
        'reboque_prop',
        'reboque_prop_cpfcnpj',
        'reboque_prop_rntrc',
        'reboque_prop_nome',
        'reboque_prop_ie',
        'reboque_prop_uf',
        'reboque_prop_tpprop',
        'reboque_codigo_veiculo'
    ];
    public $hidden = ['created_at','updated_at', 'manifesto_id'];


    public function getReboquePropCpfcnpjAttribute($value) {
        return Funcoes::formatCPFCNPJ($value);
    }
    public function setReboquePropCpfcnpjAttribute($value) {
        $this->attributes['reboque_prop_cpfcnpj'] =  Funcoes::disFormatCPFCNPJ($value);
    }
}
