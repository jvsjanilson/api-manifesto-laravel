<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManifestoRodoLacre extends Model
{
    use HasFactory;
    public $fillable = ['manifesto_id', 'nlacre'];
}
