<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    function movies(){
        return $this ->belongsToMany('App\Models\Movie');
    }

    function series(){
        return $this ->belongsToMany('App\Models\Serie');
    }

    function stars(){
        return $this ->belongsToMany('App\Models\Star');
    }
}
