<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManifestoLacre extends Model
{
    use HasFactory;
    public $fillable = ['manifesto_id','numero'];
    public $hidden = ['created_at','updated_at', 'manifesto_id'];
}
