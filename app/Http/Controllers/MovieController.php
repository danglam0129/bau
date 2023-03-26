<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;
use App\Models\Star;
use App\Models\Country;
use App\Models\Genre;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class MovieController extends Controller
{
    //
    public function list(Request $request)
    {
        $genres = Genre::whereHas('movies')->get();
        $data = $request->all();
        $countries = Country::whereHas('movies')->get();
        $movies = Movie::query();
        if ($request->has('Genres') && !empty($request->input('Genres'))) {
            $movies->whereHas('genres', function ($query) use ($request) {
                $query->where('name', $request->input('Genres'));
            });
        }

        if ($request->has('Country') && !empty($request->input('Country'))) {
            $movies->whereHas('countries', function ($query) use ($request) {
                $query->where('name', $request->input('Country'));
            });
        }

        if ($request->has('Year') && !empty($request->input('Year'))) {
            $movies->whereYear('year', $request->input('Year'));
        }

        $movies = $movies->orderby('id', 'desc')->paginate(36);

        return view('movies', compact('movies', 'genres', 'countries','data'));
    }

    public function detail($slug){
        $movie=Movie::where('slug', $slug)->firstOrFail();
        $list_movies= Movie::inRandomOrder()->take(8)->get();
        $response = Http::withToken(config('services.tmdb.token'))
        ->get('https://api.themoviedb.org/3/movie/' . $movie['tmdb'].'/images');
    if ($response->successful()) {
        $images = $response->json();
        $imgs = array_slice($images['backdrops'], 0, 6);
        return view('detail',compact('movie','list_movies','imgs'));
    } else {
        return view('detail',compact('movie','list_movies'));
    }
    }

    public function watch($slug){
        $movie=Movie::where('slug', $slug)->firstOrFail();
        $list_movies= Movie::inRandomOrder()->take(8)->get();
        return view('watch',compact('movie','list_movies'));
    }



    public function index($idtmdb)
    {
        //         $popularmovies = Http::withToken(config('services.tmdb.token'))
        // -> get('https://api.themoviedb.org/3/movie/popular')
        // -> json()['results'];
        // dd($popularmovies);

        if (!Movie::where('tmdb', $idtmdb)->exists()) {
            $movi = Http::withToken(config('services.tmdb.token'))
                ->get('https://api.themoviedb.org/3/movie/' . $idtmdb)
                ->json();

            $cast = Http::withToken(config('services.tmdb.token'))
                ->get('https://api.themoviedb.org/3/movie/' . $idtmdb . '/credits')
                ->json();



            if (!isset($movi['success'])) {

                $name = $movi['title'];
                $country = $movi['production_countries'];
                $date = $movi['release_date'];
                $runtime = $movi['runtime'];
                $revenue = $movi['revenue'];
                $rate = $movi['vote_average'];
                $genres = $movi['genres'];
                $tagline = $movi['tagline'];
                $poster = $movi['poster_path'];
                $backdrop = $movi['backdrop_path'];
                $overview = $movi['overview'];
                $slug = Str::slug($name);
                $trailers = Http::withToken(config('services.tmdb.token'))
                    ->get('https://api.themoviedb.org/3/movie/' . $idtmdb . '/videos')
                    ->json();
                if (count($trailers['results']) > 0) {
                    $trailer = $trailers['results'][0]['key'];
                } else {
                    $trailer = "";
                };
                if (!empty($backdrop)) {
                    $link = "https://image.tmdb.org/t/p/original" . $backdrop;
                    $content = file_get_contents($link);
                    Storage::disk('public')->put($backdrop, $content);
                };

                $crews = $cast['crew'];
                $director = "N/A";
                foreach ($crews as $crew) {
                    if ($crew['job'] == 'Director') {
                        $director = $crew['name'];
                        break;
                    }
                }
                $link2 = "https://image.tmdb.org/t/p/w500" . $poster;
                $content2 = file_get_contents($link2);
                Storage::disk('public')->put($poster, $content2);

                Movie::create([
                    'name' => $name,
                    'detail' => $overview,
                    'slug' => $slug,
                    'year' => $date,
                    'time' => $runtime,
                    'poster' => $poster,
                    'backdrop' => $backdrop,
                    'revenue' => $revenue,
                    'rate' => $rate,
                    'tagline' => $tagline,
                    'tmdb' => $idtmdb,
                    'trailer' => $trailer,
                    'director' => $director,

                ]);
                //genres
                foreach ($genres as $genre) {
                    $genre_id = $genre['id'];
                    $check_genre = Genre::where('tmdb', $genre_id)->count();
                    if ($check_genre == 0) {
                        $genre_name = $genre['name'];
                        Genre::create([
                            'name' => $genre_name,
                            'tmdb' => $genre_id,
                        ]);
                    };
                    $genree = Genre::where('tmdb', $genre_id)->first();
                    $genree_id = $genree['id'];
                    $movie_star = Movie::where('tmdb', $idtmdb)->first();
                    $id = $movie_star['id'];
                    $movieee = Movie::find($id);
                    $movieee->genres()->syncWithoutDetaching($genree_id);
                };
                //country
                if (count($country) > 0) {
                    $country_1 = $country[0];
                    $country_name = $country_1['name'];
                    $check_country = Country::where('name', $country_name)->count();
                    if ($check_country == 0) {
                        Country::create([
                            'name' => $country_name,
                        ]);
                    };
                    $check_country2 = Country::where('name', $country_name)->first();
                    $country_id = $check_country2['id'];
                    $movieee->countries()->syncWithoutDetaching($country_id);
                };

                //cast
                $t = count($cast['cast']);
                if ($t < 10) {
                    $stars = $cast['cast'];
                    foreach ($stars as $star) {
                        $star_id = $star['id'];
                        $check_star = Star::where('tmdb', $star_id)->count();
                        if ($check_star == 0) {
                            $staa = Http::withToken(config('services.tmdb.token'))
                                ->get('https://api.themoviedb.org/3/person/' . $star_id)
                                ->json();
                            $star_name = $staa['name'];
                            $profile_poster = $staa['profile_path'];
                            $slug_star = Str::slug($star_name);
                            $birthday = $staa['birthday'];
                            $job = $staa['known_for_department'];
                            $place_of_birth = $staa['place_of_birth'];
                            $bio = $staa['biography'];
                            $gender = $staa['gender'];
                            if ($gender == 1) {
                                $gender = "female";
                            } else {
                                $gender = 'male';
                            };
                            if (!empty($profile_poster)) {
                                $link3 = "https://image.tmdb.org/t/p/w500" . $profile_poster;
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
                        $stai = Star::where('tmdb', $star_id)->first();
                        $stari_id = $stai['id'];
                        $movieee->stars()->syncWithoutDetaching($stari_id);
                    }
                } else {
                    for ($i = 0; $i < 10; $i++) {
                        $star = $cast['cast'][$i];
                        $star_id = $star['id'];
                        $check_star = Star::where('tmdb', $star_id)->count();
                        if ($check_star == 0) {
                            $staa = Http::withToken(config('services.tmdb.token'))
                                ->get('https://api.themoviedb.org/3/person/' . $star_id)
                                ->json();
                            $star_name = $staa['name'];
                            $profile_poster = $staa['profile_path'];
                            $slug_star = Str::slug($star_name);
                            $birthday = $staa['birthday'];
                            $job = $staa['known_for_department'];
                            $place_of_birth = $staa['place_of_birth'];
                            $bio = $staa['biography'];
                            $gender = $staa['gender'];
                            if ($gender == 1) {
                                $gender = "female";
                            } else {
                                $gender = 'male';
                            };
                            if (!empty($profile_poster)) {
                                $link3 = "https://image.tmdb.org/t/p/w500" . $profile_poster;
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
                        $stai = Star::where('tmdb', $star_id)->first();
                        $stari_id = $stai['id'];
                        $movieee->stars()->syncWithoutDetaching($stari_id);
                    }
                }


                return 'Da Them Thanh Cong Movie : ' . $name;
            } else {
                return "Loi Khong Co Phim";
            }
        } else {
            return "Đã tồn tại phim";
        }
    }



    public function update(){
        $staris = Star::all();
        foreach($staris as $stari){
            $stari = Http::withToken(config('services.tmdb.token'))
                                ->get('https://api.themoviedb.org/3/person/' . $stari['tmdb'])
                                ->json();
            $birthday = null;
            if (array_key_exists('birthday', $stari)) {
                $birthday = $stari['birthday'];
            }
                Star::where('id', $stari['id'])->update(['birthday'=>$birthday]);
        }
    }
}
