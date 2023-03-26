<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Star;
use App\Models\Post;
use App\Models\Country;

class StarController extends Controller
{
    //
    public function list(Request $request){
        $countries = Country::all();
        $stars = Star::query();
        if ($request->has('Country') && !empty($request->input('Country'))) {
            $stars->where('place', $request->input('Country'));
        }
        if ($request->has('Gender') && !empty($request->input('Gender'))) {
            $stars->where('gender', $request->input('Gender'));
        }

        $stars = $stars->orderby('id', 'desc')->paginate(36);

        return view('stars', compact('stars','countries'));
    }

    public function detail($slug){
        $star=Star::where('slug', $slug)->firstOrFail();
        $posts=Post::inRandomOrder()->take(4)->get();
        return view('star-detail',compact('star','posts'));
    }
}
