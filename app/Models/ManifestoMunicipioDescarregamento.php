<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManifestoMunicipioDescarregamento extends Model
{
    use HasFactory;
    public $fillable = ['manifesto_id','estado_id','municipio_id'];
    public $hidden = ['created_at','updated_at', 'manifesto_id'];

    public function estado()
    {
        return $this->belongsTo(Estado::class);
    }

    public function municipio()
    {
        return $this->belongsTo(Municipio::class);
    }
}
