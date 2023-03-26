<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sub extends Model
{
    use CrudTrait;
    use HasFactory;

    protected $fillable = ['name','link','episode_id','movie_id','url'];

    function episodes(){
        return $this->belongsTo('App\Models\Serie');
    }

    function movies(){
        return $this->belongsTo('App\Models\Episode');
    }

}
