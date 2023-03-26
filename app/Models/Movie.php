<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Movie extends Model
{
    use CrudTrait;
    use HasFactory;
    use Searchable;

    protected $fillable = ['name','detail','slug','year','time','poster','backdrop','revenue','rate','tagline','tmdb','trailer','director','converted_video_url','video_url','overview','subtitle_url'];

    function stars(){
        return $this ->belongsToMany('App\Models\Star');
    }

    function genres(){
        return $this ->belongsToMany('App\Models\Genre');
    }

    function countries(){
        return $this ->belongsToMany('App\Models\Country');
    }

    function tags(){
        return $this ->belongsToMany('App\Models\Tag');
    }

    function subs(){
        return $this ->hasMany('App\Models\Sub');
    }
}
