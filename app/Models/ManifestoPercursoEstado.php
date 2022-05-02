<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManifestoPercursoEstado extends Model
{
    use HasFactory;
    public $fillable = ['estado_id', 'manifesto_id'];

    public function estado()
    {
        return $this->belongsTo(Estado::class);
    }
}
