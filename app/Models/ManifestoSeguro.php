<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManifestoSeguro extends Model
{
    use HasFactory;
    public $fillable = ['manifesto_id', 'resp_seg','cpfcnpj','nome_seguradora','cnpj_seguradora','numero_apolice'];

    /**
     * Relations
     */
    public function averbacoes(){
        return $this->hasMany(ManifestoSeguroAverbacao::class);
    }

    /**
     * Getters
     */
    public function getCpfcnpjAttribute($value)
    {
        return Funcoes::formatCPFCNPJ($value);
    }

    public function getCnpjSeguradoraAttribute($value)
    {
        return Funcoes::formatCPFCNPJ($value);
    }

    /**
     * Setters
     */
    public function setCpfcnpjAttribute($value)
    {
        $this->attributes['cpfcnpj'] = Funcoes::disFormatCPFCNPJ($value);
    }

    public function setCnpjSeguradoraAttribute($value)
    {
        $this->attributes['cnpj_seguradora'] = Funcoes::disFormatCPFCNPJ($value);
    }


}
