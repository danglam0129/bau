@extends('layout.layout')
@section('title', 'Xenews | Movies - Series- Stars - News')
@section('description', 'The aim of our website is to entertain our visitors' )
@section('canonical')
{{url()->current()}}
@endsection
@section('content')
    <!-- News -->
    <div class="wp-content bg-main3">
        <div class="container pt-3 pt-md-4">
            <div class="row">
                <div class="col-md-8 col-lg-9">
                    <div class="h1 text-main h1news">NEWS</div>
                    <div class="news-list">
                        @foreach ($posts as $post)
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
                                            <a href="">News</a>
                                        </div>
                                        <div class="col-6 col-lg-3 news-author">
                                            <a href="{{ url($post['slug']) }}">Admin</a>
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

                    </div>
                    <!-- End News -->

                    <!-- Movies  -->
                    <h2 class="pt-3 text-main" style="font-weight: 700;">TRENDING MOVIES</h2>
                    <div class="movies-list owl-carousel owl-theme">
                        @foreach ($trendmovies as $trendmovie )
                        <div class="movies-iteam">
                            <a href="{{ url('movies/'.$trendmovie['slug']) }}"><img src="{{ $trendmovie['poster'] }}"
                                    alt=""></a>
                            <div class="movies-in text-center">
                                <span>{{ $trendmovie['time'] }} mins</span>
                            </div>
                            <div class="movies-name">
                                <a href="{{ url('movies/'.$trendmovie['slug']) }}">{{ $trendmovie['name'] }}</a>
                            </div>
                            <div class="movies-category">
                                @foreach( $trendmovie->genres as $genre)
                                    <a href="{{url('movies/'.$trendmovie['slug'])}}">{{ $genre['name']}} ,</a>
                                  @endforeach
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <hr class="hr1">

                    <h2 class="pt-3 text-main" style="font-weight: 700;">NEW MOVIES</h2>

                    <div class="movies-list owl-carousel owl-theme">
                        @foreach ($newmovies as $newmovie )
                        <div class="movies-iteam">
                            <a href="{{ url('movies/'.$newmovie['slug']) }}"><img src="{{ $newmovie['poster'] }}"
                                    alt=""></a>
                            <div class="movies-in text-center">
                                <span>{{ $newmovie['time'] }} mins</span>
                            </div>
                            <div class="movies-name">
                                <a href="{{ url('movies/'.$newmovie['slug']) }}">{{ $newmovie['name'] }}</a>
                            </div>
                            <div class="movies-category">
                                @foreach( $newmovie->genres as $genre)
                                    <a href="{{url('movies/'.$newmovie['slug'])}}">{{ $genre['name']}} ,</a>
                                  @endforeach
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <hr class="hr1">

                    <h2 class="pt-3 text-main" style="font-weight: 700;">ONSHOWING SERIES</h2>

                    <div class="movies-list owl-carousel owl-theme">
                        @foreach ($onseries as $onserie )
                        <div class="movies-iteam">
                            <a href="{{ url('series/'.$onserie->slug) }}"><img src="{{ url('public'.$onserie->poster) }}"
                                    alt=""></a>
                            <div class="movies-in text-center">
                                <span>{{ $onserie->num_seasons }} Episodes</span>
                            </div>
                            <div class="movies-name">
                                <a href="{{ url('series/'.$onserie->slug) }}">{{ $onserie->name }}</a>
                            </div>
                            <div class="movies-category">
                                    <a href="{{url('series/'.$onserie->slug)}}">{{ $onserie->genres}} </a>
                            </div>
                        </div>
                        @endforeach

                    </div>
                    <hr class="hr1">

                    <h2 class="pt-3 text-main" style="font-weight: 700;">TRENDING SERIES</h2>

                    <div class="movies-list owl-carousel owl-theme">
                        @foreach ($trendseries as $trendserie )
                        <div class="movies-iteam">
                            <a href="{{ url('series/'.$trendserie['slug']) }}"><img src="{{ url('public'.$trendserie['poster']) }}"
                                    alt=""></a>
                            <div class="movies-in text-center">
                                <span>{{ count($trendserie->seasons) }} Episodes</span>
                            </div>
                            <div class="movies-name">
                                <a href="{{ url('series/'.$trendserie['slug']) }}">{{ $trendserie['name'] }}</a>
                            </div>
                            <div class="movies-category">
                                @foreach( $trendserie->genres as $genre)
                                    <a href="{{url('series/'.$trendserie['slug'])}}">{{ $genre['name']}} ,</a>
                                  @endforeach
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <hr class="hr1">

                    <!-- End Movies  -->
                </div>
            @endsection
