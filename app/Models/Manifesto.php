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
    //public $hidden = ['created_at','updated_at'];



    public function condutors()
    {
        return $this->hasMany(ManifestoCondutor::class);
    }

    public function contratantes()
    {
        return $this->hasMany(ManifestoContratante::class);
    }

    public function ciots()
    {
        return $this->hasMany(ManifestoCiot::class);
    }

    public function autorizacaos()
    {
        return $this->hasMany(ManifestoAutorizacao::class);
    }

    public function ctes()
    {
        return $this->hasMany(ManifestoCte::class);
    }

    public function lacres()
    {
        return $this->hasMany(ManifestoLacre::class);
    }

    public function municipiosCarregamento()
    {
        return $this->hasMany(ManifestoMunicipioCarregamento::class);
    }

    public function municipiosDescarregamento()
    {
        return $this->hasMany(ManifestoMunicipioDescarregamento::class);
    }

    public function nfes()
    {
        return $this->hasMany(ManifestoNfe::class);
    }

    public function pedagios()
    {
        return $this->hasMany(ManifestoPedagio::class);
    }

    public function percuroEstados()
    {
        return $this->hasMany(ManifestoPercursoEstado::class);
    }

    public function produtoPredominante()
    {
        return $this->hasMany(ManifestoProdutoPredominante::class);
    }

    public function reboques()
    {
        return $this->hasMany(ManifestoReboque::class);
    }

    public function rodoLacres()
    {
        return $this->hasMany(ManifestoRodoLacre::class);
    }

    public function seguros()
    {
        return $this->hasMany(ManifestoSeguro::class);
    }

    public function veiculoTracao()
    {
        return $this->hasOne(ManifestoTracao::class);
    }


}
