<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Movie;
use App\Models\Serie;
use Illuminate\Support\Facades\DB;


class HomeController extends Controller
{
    public function list(){
        $posts= Post::orderby('id', 'desc')->limit(10)->get();
        $trendmovies = Movie::inRandomOrder()->take(10)->get();
        $newmovies = Movie::orderBy('id','desc')->limit(10)->get();
        $onseries = DB::table('series')
    ->join('seasons', 'series.id', '=', 'seasons.serie_id')
    ->join('episodes', 'seasons.id', '=', 'episodes.season_id')
    ->join('genre_serie', 'series.id', '=', 'genre_serie.serie_id')
    ->join('genres', 'genre_serie.genre_id', '=', 'genres.id')
    ->select('series.id','series.name','series.poster','series.slug','episodes.created_at',DB::raw('count(seasons.id) as num_seasons'),DB::raw('group_concat(distinct genres.name) as genres'))
    ->groupBy('series.id','series.name','series.poster','series.slug','episodes.created_at')
    ->orderBy('episodes.created_at', 'desc')
    ->take(10)
    ->get();
        $trendseries = Serie::inRandomOrder()->take(10)->get();
        return view('home', compact('posts','onseries','newmovies','trendmovies','trendseries'));
    }

}
