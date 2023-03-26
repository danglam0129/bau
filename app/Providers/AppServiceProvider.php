<?php

namespace App\Providers;
use App\Models\Post;
use App\Models\Movie;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('layout.sidebar', function($view){
            $features = Post::inRandomOrder()->take(10)->get();
            $sidemovies = Movie::inRandomOrder()->take(10)->get();
            $view->with('features', $features)->with('sidemovies', $sidemovies);
        });


    }
}
