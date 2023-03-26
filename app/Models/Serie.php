<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Serie extends Model
{
    use CrudTrait;
    use HasFactory;
    use Searchable;

    protected $fillable = ['name','detail','slug','year','poster','backdrop','rate','tagline','tmdb','trailer','director','overview'];

    function stars(){
        return $this ->belongsToMany('App\Models\Star');
    }

    function genres(){
        return $this ->belongsToMany('App\Models\Genre');
    }

    function seasons(){
        return $this ->hasMany('App\Models\Season');
    }
    
    function countries(){
        return $this ->belongsToMany('App\Models\Country');
    }

    function tags(){
        return $this ->belongsToMany('App\Models\Tag');
    }
}
