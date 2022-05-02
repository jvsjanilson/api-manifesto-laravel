<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManifestoCondutor extends Model
{
    use HasFactory;
    public $fillable = ['nome', 'cpf','manifesto_id'];

    public function getCpfAttribute($value)
    {
        return Funcoes::formatCPFCNPJ($value);
    }
}
