<?php

namespace App\Models;

use App\Traits\GenericTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManifestoAutorizacao extends Model
{
    use HasFactory;
    public $fillable = ['manifesto_id', 'cpfcnpj'];
    public $hidden = ['created_at','updated_at', 'manifesto_id'];



    public function getCpfcnpjAttribute($value)
    {
        return Funcoes::formatCPFCNPJ($value);
    }

    public function setCpfcnpjAttribute($value)
    {
        $this->attributes['cpfcnpj'] =  Funcoes::disFormatCPFCNPJ($value);
    }
}
