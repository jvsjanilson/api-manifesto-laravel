<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManifestoSeguroAverbacao extends Model
{
    use HasFactory;
    public $fillable = ['manifesto_id', 'manifesto_seguro_id', 'numero'];
}
