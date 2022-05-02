<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManifestoPedagio extends Model
{
    use HasFactory;
    public $fillable = ['manifesto_id', 'cnpj_fornecedor','cpfcnpj_responsavel','numero_comprovante','valor_vale'];


    public function getValorValeAttribute($value)
    {
        $value = !isset($value) ? '0.00' : $value;
        return Funcoes::formatFloatBr($value);
    }

    public function getCnpjFornecedorAttribute($value)
    {
        return Funcoes::formatCPFCNPJ($value);
    }

    public function getCpfcnpjResponsavelAttribute($value)
    {
        return Funcoes::formatCPFCNPJ($value);
    }
}
