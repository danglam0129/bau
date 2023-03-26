<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Episode extends Model
{
    use CrudTrait;
    use HasFactory;

    protected $fillable = ['name','overview','slug','poster','tmdb','season_id','tagline','converted_video_url','video_url','subtitle_url'];


    function season(){
        return $this->belongsTo('App\Models\Season');
    }

    function subs(){
        return $this ->hasMany('App\Models\Sub');
    }
}
