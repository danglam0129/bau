<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use CrudTrait;
    use HasFactory;

    protected $fillable = ['name','slug'];

    function movies(){
        return $this ->belongsToMany('App\Models\Movie');
    }

    function series(){
        return $this ->belongsToMany('App\Models\Serie');
    }

    function stars(){
        return $this ->belongsToMany('App\Models\Star');
    }

    function posts(){
        return $this ->belongsToMany('App\Models\Post');
    }
}
