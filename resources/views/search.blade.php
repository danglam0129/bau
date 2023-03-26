@extends('layout.layout')

@section('content')
    <!-- Stars -->

    <div class="wp-content bg-main3">

        <div class="container pt-3 pt-md-4">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item text-1"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Stars</li>
                </ol>
            </nav>
            <div class="row">
                <div class="col-md-8 col-lg-9">
                    <h2>Movies</h2>
                    <div class="row">
                        @foreach ($semovies as $semovie)
                        <div class="stars col-4 col-lg-3 col-xxl-2">
                            <a href="{{ url('movies').$semovie['slug'] }}">
                                <img src="{{ asset('public').$semovie['poster'] }}" alt="">
                            </a>
                            <div class="molist-in text-center">
                                <span>{{ $semovie['time'] }} mins</span>
                            </div>
                            <a class="star-name" href="{{ url('movies').$semovie['slug'] }}">
                                <div class="no-wrap">{{ $semovie['name'] }}</div>
                            </a>
                            <div class="movies-category">
                                @foreach( $semovie->genres as $genre)
                                    <a href="{{ url('movies/'.$semovie['slug']) }}">{{ $genre['name']}} ,</a>
                                @endforeach
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="paginate">
                        <ul>
                            {{ $semovies->appends($data)->links('paginate') }}
                        </ul>
                    </div>
                    <hr>

                    <h2>Series</h2>
                    <div class="row">
                        @foreach ($seseries as $serie )
                            <div class="stars col-4 col-lg-3 col-xxl-2">
                                <a href="{{ url('series/'.$serie['slug']) }}">
                                    <img src="{{ asset('public'.$serie['poster']) }}" alt="">
                                </a>
                                <div class="molist-in text-center">
                                    <span>{{count($serie->seasons)}} seasons</span>
                                </div>
                                <a class="star-name" href="">
                                    <div class="no-wrap">{{ $serie['name'] }}</div>
                                </a>
                                <div class="movies-category">
                                    @foreach( $serie->genres as $genre)
                                    <a href="{{ url('series/'.$serie['slug']) }}">{{ $genre['name']}} ,</a>
                                    @endforeach
                                </div>
                            </div> 
                            @endforeach
                    </div>
                    <div class="paginate">
                        <ul>
                            {{ $seseries->appends($data)->links('paginate') }}
                        </ul>
                    </div>
                    <hr>

                    <h2>Stars</h2>
                    <div class="row">
                        @foreach($sestars as $star)
                            <div class="stars col-4 col-lg-3 col-xxl-2">
                                <a href="{{ url('stars/'.$star['slug']) }}">
                                    <img src="{{ asset('public'.$star['poster']) }}" alt="">
                                </a>
                                <a class="star-name" href="{{ url('stars/'.$star['slug']) }}">
                                    <div class="no-wrap">{{ $star['name'] }}</div>
                                </a>
                            </div>
                            @endforeach
                    </div>
                    <div class="paginate">
                        <ul>
                            {{ $sestars->appends($data)->links('paginate') }}
                        </ul>
                    </div>
                    <hr>

                    <h2>News</h2>
                    @foreach ($seposts as $post)
                        <div class="news-iteam bg-dark">
                            <div class="row h-100">
                                <div class="col-5 col-md-5 col-xl-4 pl0 d-flex align-items-center h-100">
                                    <a href="{{ url($post['slug']) }}" class="h-100 w-100 d-block text-center"><img class="news-image"
                                            src="{{ asset('image/'.$post['link']) }}"
                                            alt=""></a>
                                </div>
                                <div class="col-7 col-md-7 col-xl-8 pt-2">
                                    <div class="h4 no-wrap"><a class="h4title"
                                            href="{{ url($post['slug']) }}">{{ $post['title'] }}</a></div>
                                    <div class="row mb-2">
                                        <div class="col-6 col-lg-2 newscategory">
                                            <a href="">Movies</a>
                                        </div>
                                        <div class="col-6 col-lg-3 news-author">
                                            <a href="{{ url($post['slug']) }}">News</a>
                                        </div>
                                        <div class="newstime col-7 col-lg-5">
                                            {{ $post['date'] }}
                                        </div>
                                        <div class="col-5 col-lg-2 newscmt">
                                            <img src="{{ asset('image/chat-left-text-fill.svg') }}" alt="">
                                            <span>22</span>
                                        </div>
                                    </div>
                                    <div class="news-description">
                                        <x-markdown>
                                            {{ substr(strip_tags($post['content']), 0, 300) }}
                                        </x-markdown>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        <div class="paginate">
                            <ul>
                                {{ $seposts->appends($data)->links('paginate') }}
                            </ul>
                        </div>
                        <hr>

                </div>
                <!-- End Stars -->
            @endsection
