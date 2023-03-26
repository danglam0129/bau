<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;
use App\Models\Serie;
use App\Models\Star;
use App\Models\Post;

class SearchController extends Controller
{
    //
    public function search(Request $request){
        $q = "";
        $data = $request->all();
        if($request->input('q')){
            $q = $request->input('q');
        }
        $semovies = Movie::search($q)->paginate(12);
        $seseries = Serie::search($q)->paginate(12);
        $seposts = Post::search($q)->paginate(5);
        $sestars =  Star::search($q)->paginate(12);
        return view('search', compact('semovies','q','seseries','data','seposts','sestars'));
    }
}
