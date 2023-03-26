<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Star extends Model
{
    use CrudTrait;
    use HasFactory;
    use Searchable;

    protected $fillable = ['name','tmdb','poster','gender','slug','birthday','job','place','bio'];
    function movies(){
        return $this ->belongsToMany('App\Models\Movie');
    }

    function series(){
        return $this ->belongsToMany('App\Models\Serie');
    }

    function countries(){
        return $this ->belongsToMany('App\Models\Country');
    }

    function tags(){
        return $this ->belongsToMany('App\Models\Tag');
    }
}
