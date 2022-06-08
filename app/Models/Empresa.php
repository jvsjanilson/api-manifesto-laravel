<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Webpatser\Uuid\Uuid;

class Empresa extends Model
{
    use HasFactory;

    protected $guarded = ['id'];


    public static function boot()
    {
        parent::boot();
        self::creating(function($model){
            $model->uuid = (string) Uuid::generate(4);
        });
    }


    //** Begining Relation */
    public function estado()
    {
        return $this->belongsTo(Estado::class);
    }

    public function municipio()
    {
        return $this->belongsTo(Municipio::class);
    }
    /** Finish Relation */



}
