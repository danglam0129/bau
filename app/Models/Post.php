<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Post extends Model
{
    use CrudTrait;
    use HasFactory;
    use Searchable;

    protected $fillable = ['oid','author','date','content','title','slug'];

    function tags(){
        return $this ->belongsToMany('App\Models\Tag');
    }

}
