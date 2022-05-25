<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManifestoNfe extends Model
{

    use HasFactory;

    public $fillable = ['manifesto_id', 'municipio_id', 'chave', 'segcodbarras'];
    public $table = 'manifesto_nfes';
    public $hidden = ['created_at','updated_at', 'manifesto_id'];

    public function municipio()
    {
        return $this->belongsTo(Municipio::class);
    }
}
