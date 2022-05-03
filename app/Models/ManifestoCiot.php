<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManifestoCiot extends Model
{
    use HasFactory;

    public $fillable = ['manifesto_id','ciot', 'cpfcnpj'];

    public function getCpfcnpjAttribute($value)
    {
        return Funcoes::formatCPFCNPJ($value);
    }

    public function setCpfcnpjAttribute($value)
    {
        $this->attributes['cpfcnpj'] =  Funcoes::disFormatCPFCNPJ($value);
    }

}
