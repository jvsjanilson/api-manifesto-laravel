<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManifestoAutorizacao extends Model
{
    use HasFactory;
    public $fillable = ['manifesto_id', 'cpfcnpj'];

    public function getCpfcnpjAttribute($value)
    {
        return Funcoes::formatCPFCNPJ($value);
    }
}
