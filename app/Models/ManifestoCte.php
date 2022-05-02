<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManifestoCte extends Model
{
    use HasFactory;
    public $fillable = ['manifesto_id', 'municipio_id', 'chave'];


    public function municipio()
    {
        return $this->belongsTo(Municipio::class);
    }
}
