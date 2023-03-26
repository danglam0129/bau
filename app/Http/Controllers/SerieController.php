<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Star;
use App\Models\Country;
use App\Models\Genre;
use App\Models\Serie;
use App\Models\Season;
use App\Models\Episode;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class SerieController extends Controller
{
    //
    // public function update(){
    //     $series = Serie::all();
    //     foreach($series as $serie){
    //         $updatese = Http::withToken(config('services.tmdb.token'))
    //             ->get('https://api.themoviedb.org/3/tv/' . $serie['tmdb'])
    //             ->json();
    //             $vote = null;
    //             if (array_key_exists('vote_average', $updatese)) {
    //             $vote = $updatese['vote_average'];
    //         }
    //             Serie::where('id',$serie['id'])->update(['rate'=>$vote]);
    //     }
    // }

    public function list(Request $request){
        $genres = Genre::whereHas('series')->get();
        $countries = Country::whereHas('series')->get();
        $data = $request->all();
        $series = Serie::query();
        if ($request->has('Genres') && !empty($request->input('Genres'))) {
            $series->whereHas('genres', function ($query) use ($request) {
                $query->where('name', $request->input('Genres'));
            });
        }

        if ($request->has('Country') && !empty($request->input('Country'))) {
            $series->whereHas('countries', function ($query) use ($request) {
                $query->where('name', $request->input('Country'));
            });
        }

        if ($request->has('Year') && !empty($request->input('Year'))) {
            $series->whereYear('year', $request->input('Year'));
        }

        $series = $series->orderby('id', 'desc')->paginate(36);

        return view('series', compact('series', 'genres', 'countries','data'));
    }

    public function detail($slug){
        $serie=Serie::where('slug', $slug)->firstOrFail();
        $list_series= Serie::inRandomOrder()->take(8)->get();
        $response = Http::withToken(config('services.tmdb.token'))
        ->get('https://api.themoviedb.org/3/tv/' . $serie['tmdb'].'/images');
    if ($response->successful()) {
        $images = $response->json();
        $imgs = array_slice($images['backdrops'], 0, 6);
        return view('serie-detail',compact('serie','list_series','imgs'));
    } else {
        return view('serie-detail',compact('serie','list_series'));
    }
    }

    public function season($slug, $seasonslug){
        $serie = Serie::where('slug', $slug)->firstOrFail();
        $list_series= Serie::inRandomOrder()->take(8)->get();
        $season = Season::where('serie_id',$serie['id'])->where('slug',$seasonslug)->firstOrFail();
        return view('season', compact('serie','season','list_series'));
    }

    public function index($idtmdb){
        if (!Serie::where('tmdb', $idtmdb)->exists()) {
            $seri = Http::withToken(config('services.tmdb.token'))
            -> get('https://api.themoviedb.org/3/tv/'.$idtmdb)
            -> json();
    
            $cast = Http::withToken(config('services.tmdb.token'))
            -> get('https://api.themoviedb.org/3/tv/'.$idtmdb.'/credits')
            -> json();
            if(!isset($seri['success'])){
                $name = $seri['name'];
                $country = $seri['production_countries'];
                $date = $seri['first_air_date'];
                $rate = $seri['vote_average'];
                $genres = $seri['genres'];
                $tagline = $seri['tagline'];
                $poster = $seri['poster_path'];
                $backdrop = $seri['backdrop_path'];
                $overview = $seri['overview'];
                $slug = Str::slug($name);
                $seasons = $seri['seasons'];
                if(!empty($seri['created_by'][0]['name'])){
                $director = $seri['created_by'][0]['name'];
            }
            else{
                $director = "";
            }
                $trailers = Http::withToken(config('services.tmdb.token'))
            -> get('https://api.themoviedb.org/3/tv/'.$idtmdb.'/videos')
            -> json();
            if(count($trailers['results']) > 0){
                $trailer = $trailers['results'][0]['key'];
            }
            else{
                $trailer = "";
            };
            if(!empty($backdrop)){
                $link = "https://image.tmdb.org/t/p/original".$backdrop;
                $content = file_get_contents($link);
                Storage::disk('public')->put($backdrop, $content);
                };
            $link2 = "https://image.tmdb.org/t/p/w500".$poster;
            $content2 = file_get_contents($link2);
            Storage::disk('public')->put($poster, $content2);
    
            Serie::create([
                'name' => $name,
                'detail' => $overview,
                'slug' => $slug,
                'year' => $date,
                'poster' => $poster,
                'backdrop' => $backdrop,
                'rate' => $rate,
                'tagline' => $tagline,
                'tmdb' => $idtmdb,
                'trailer' => $trailer,
                'director' => $director,
    
            ]);
            //genres
            $serie_star = Serie::where('tmdb', $idtmdb) -> first();
            $id = $serie_star['id'];
            $serieee = Serie::find($id);
            if(!empty($genres)){
            foreach($genres as $genre){
                $genre_id = $genre['id'];
                $check_genre = Genre::where('tmdb', $genre_id) -> count();
                if($check_genre == 0){
                    $genre_name = $genre['name'];
                    Genre::create([
                        'name' => $genre_name,
                        'tmdb' => $genre_id,
                    ]);
                };
            $genree = Genre::where('tmdb', $genre_id) -> first();
            $genree_id = $genree['id'];
            $serieee->genres()->syncWithoutDetaching($genree_id);
            };
        };
            //country
            if(is_countable($country) && count($country) > 0){
                $country_1 = $country[0];
                $country_name = $country_1['name'];
                $check_country = Country::where('name',$country_name) ->count();
                if($check_country == 0){
                    Country::create([
                        'name' => $country_name,
                    ]);
                };
                $check_country2 = Country::where('name',$country_name) ->first();
                $country_id = $check_country2['id'];
                $serieee->countries()->syncWithoutDetaching($country_id);
            };
    
            //season
            if(is_countable($seasons) && count($seasons) > 0){
                foreach($seasons as $season){
                    
                    Season::create([
                        'name' => $season['name'],
                        'tmdb' => $season['id'],
                        'episode' => $season['episode_count'],
                        'poster' => $season['poster_path'],
                        'overview' => $season['overview'],
                        'slug' => Str::slug($season['name']),
                        'serie_id' => $id,
                        'number' => $season['season_number'],
                        'date' => $season['air_date'],
                    ]);
                    if(!empty($season['poster_path'])){
                    $link4 = "https://image.tmdb.org/t/p/w500".$season['poster_path'];
                    $content4 = file_get_contents($link4);
                    Storage::disk('public')->put($season['poster_path'], $content4);
                    };
    
                    //Episode
                    $check_season = Season::where('tmdb',$season['id'] ) -> first();
                    $episodes = Http::withToken(config('services.tmdb.token'))
                    -> get('https://api.themoviedb.org/3/tv/'.$idtmdb.'/season'.'/'.$season['season_number'])
                    -> json();
                    foreach($episodes['episodes'] as $episode){
            $epname = $seri['name'].' '.$season['name'].' episode '.$episode['episode_number'];
                        Episode::create([
                            'name' => $epname,
                            'poster' => $episode['still_path'],
                            'season_id' => $check_season['id'],
                            'slug' => Str::slug($epname),
                            'tmdb' => $episode['id'],
                            'overview' => $episode['overview'],
                            'tagline' => $episode['name'],
                        ]);
                        // if(!empty($episode['still_path'])){
                        //     $link5 = "https://image.tmdb.org/t/p/w500".$episode['still_path'];
                        //     $content5 = file_get_contents($link5);
                        //     Storage::disk('public')->put($episode['still_path'], $content5);
                        //     };
    
                    };
    
                };
            };
            //stars
                $stars = $cast['cast'];
            foreach(array_slice($stars,0,10) as $star){          
                $star_id = $star['id'];
                $check_star = Star::where('tmdb', $star_id) -> count();
            if($check_star == 0){
                $staa = Http::withToken(config('services.tmdb.token'))
                -> get('https://api.themoviedb.org/3/person/'.$star_id)
                -> json();
                $star_name = $staa['name'];
                $profile_poster = $staa['profile_path'];
                $slug_star = Str::slug($star_name);
                $birthday = $staa['birthday'];
                $job = $staa['known_for_department'];
                $place_of_birth = $staa['place_of_birth'];
                $bio = $staa['biography'];
                $gender = $staa['gender'];
                if($gender == 1){
                    $gender = "female";
                }
                else{
                    $gender = 'male';
                };
                if(!empty($profile_poster)){
                $link3 = "https://image.tmdb.org/t/p/w500".$profile_poster;
                $content3 = file_get_contents($link3);
                Storage::disk('public')->put($profile_poster, $content3);
            };
                Star::create([
                    'name' => $star_name,
                    'tmdb' => $star_id,
                    'poster' => $profile_poster,
                    'gender' => $gender,
                    'slug' => $slug_star,
                    'birthday' => $birthday,
                    'job' => $job,
                    'place' => $place_of_birth,
                    'bio' => $bio,
    
                ]);
            };
            //update pivot
            $stai = Star::where('tmdb', $star_id) -> first();
            $stari_id = $stai['id'];
            $serieee->stars()->syncWithoutDetaching($stari_id);
            
            }
        
            return "Da them thanh cong Series :". $name;
            }
            return "Khong co Phim";
    
        }
        else{
            return 'Đã tồn tại phim';
        }
}
}
