<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Season extends Model
{
    use CrudTrait;
    use HasFactory;

    protected $fillable = ['name','overview','slug','date','poster','episode','tmdb','serie_id','number'];
    function serie(){
        return $this->belongsTo('App\Models\Serie');
    }

    function episodes(){
        return $this->hasMany('App\Models\Episode');
    }
}
