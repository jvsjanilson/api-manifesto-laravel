<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{
    use HasFactory;
    public $fillable = [ 'uf', 'nome', 'pais_id', 'cod_ibge'];
}
