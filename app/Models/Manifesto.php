<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Manifesto extends Model
{
    use HasFactory;

    public $fillable = [
        'empresa_id',
        'modelo',
        'serie',
        'numero',
        'codigo_mdfe',
        'chave',
        'protocolo',
        'recibo',
        'modal',
        'tipoemit',
        'tipotransp',
        'datahora',
        'ufini',
        'uffim',
        'valor_carga',
        'quant_carga',
        'cunid',
        'infofisco',
        'infocompl',
        'situacao',
        'xml',
    ];

}
