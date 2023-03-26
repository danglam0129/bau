@extends('layout.layout')
@section('title')
{{$serie['name'].' Online Full Series, Full HD, English Sub'}}
@endsection
@section('description')
@if(isset($serie['detail']) && !empty($serie['detail']))
    {{ substr($serie['detail'], 0, 150) }}
@endif
@endsection
@section('canonical')
{{url()->current()}}
@endsection
@section('content')
    <!-- movies -->

    <div class="wp-content bg-main3 detail-bg" style="background-image: linear-gradient(0, rgba(252, 252, 252, 0.055), rgba(252, 252, 252, 0.3) ), url({{ asset('public'.$serie['backdrop']) }})">
        <div class="container pt-3 pt-md-4">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item text-1"><a href="{{ url('/') }}">Home</a></li>
                    <li class="breadcrumb-item text-1"><a href="{{ url('series') }}">Series</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $serie['name'] }}</li>
                </ol>
            </nav>

            <div class="wp-content row p-0 ">
                <div class="col-md-8 col-lg-9">
                    <div class="row">
                        <div class="col-12 col-md-5 col-lg-4 detail-c1 text-center">
                            <img class="main-detail-img" src="{{ asset('public'.$serie['poster']) }}" alt="">
                            <div class="row text-center d-block">
                                <a href="#"><button class="w-80 mt-2 filter-btn">Watch</button></a>
                                <a href="#trailer"><button class="w-80 mt-2 trailer-btn">Trailer</button></a>
                            </div>
                            
                        </div>
                        <div class="col-12 col-md-7 col-lg-8 px-2 bg-detail">
                            <h1>{{ $serie['name'] }}</h1>
                            <div class="row pt-2">
                                <div class="col-5 col-md-4">
                                    <div class="score-box text-center ">
                                        <img class="pb-2 pe-2" src="{{asset('image/star-fill.svg')}}" alt="">{{ $serie['rate'] }}
                                    </div>
                                </div>
                                <div class="col-7 col-md-8">
                                    <div class="your-rate">
                                      <span class="detail-i">DIRECTED BY: </span>{{ $serie['director'] }}
                                    </div>
                                    <span class="detail-i">DURATION: </span> {{ count($serie->seasons) }} seasons
                                </div>
                            </div>
                            <div class="detail-cate pt-2">
                                <span style="font-weight: 700">GENRES:</span>
                                @foreach($serie->genres as $genre)
                                <a href="{{ url('series?Genres='.$genre['name'].'&Country=&Year=') }}">{{ $genre['name'] }} ,</a>
                                @endforeach
                            </div>
                            <div class="pt-2">
                                <span class="detail-i">PUBLISH IN: </span>{{ $serie['year'] }} 
                            </div>
                            <div class="pt-2">
                              <span class="detail-i">COUNTRY: </span> @foreach($serie->countries as $country) {{ $country['name'] }} @endforeach
                          </div>
                            <div class="detail-tag pt-2">
                                <span class="detail-i">TAG:</span>
                            </div>
                            <div class="row detail-album pt-2">
                                <span class="detail-i">PHOTO AND VIDEO: </span>
                                <div class="album owl-carousel owl-theme de-img">
                                    @if(isset($imgs) && !empty($imgs))
                                    @foreach($imgs as $img)
                                    <img src="{{ 'https://image.tmdb.org/t/p/w500'.$img['file_path'] }}" alt="{{ $serie['name'].' images' }}">
                                    @endforeach
                                    @endif
                                </div>    
                            </div>
                            
                              <div class="row justify-content-around py-2">
                                <a href="#review" class="d-block w-30"><button class="filter-btn w-100"> REVIEW </button></a>
                                <a href="#comment" class="d-block w-30"><button class="cmt-btn w-100">COMMENT</button></a>
                                <a href="#share" class="d-block w-30"><button class="share-btn w-100">SHARE</button></a>
                              </div>
                            
                            
                        </div>
                    </div>
                    @if(is_countable($serie->seasons) && count($serie->seasons) > 1 )
                    <h2>SEASONS</h2>
                    <div class="season-list owl-carousel owl-theme bg-detail">
                        @foreach($serie->seasons()->get()->sortBy('name', SORT_NATURAL) as $season)
                        <div class="season-item">
                            <a href="{{ url('series/'.$serie['slug'].'/'.$season['slug']) }}"><img class="season-img"
                            src="{{ asset('public').$season['poster'] }}"
                            alt="{{ $season['name'].' poster' }}"> </a>
                            <div class="season-in text-center">
                                <span>{{ count($season->episodes) }} Episodes</span>    
                            </div>
                            <a class="star-name d-block text-center" href="{{ url('series/'.$serie['slug'].'/'.$season['slug']) }}">
                            <h5 class="no-wrap">{{ $season['name'] }}</h5>
                            </a>
                        </div>
                        @endforeach
                    </div>
                    @endif
                    <div class="detail-star bg-detail">
                        <h2 class="text-main ps-2">{{ $serie['name'].' Stars'}}</h2>
                        <div class="detail-star-list owl-carousel owl-theme">
                          @foreach($serie->stars as $star)
                            <div class="detail-star-item">
                                <a href="{{ url('stars/'.$star['slug']) }}"><img class="rounded-circle" src="{{ asset('public'.$star['poster']) }}" alt="{{ $star['name'].' poster' }}"></a>
                                <a class="star-name d-block text-center" href=""><h5 class="no-wrap">{{ $star['name'] }}</h5></a>
                            </div>
                          @endforeach  
                        </div>
                    </div>

                    <div class="detail-review bg-detail">
                        <h2 class="text-main ps-2" id="review">{{ $serie['name'].' Review' }}</h2>
                        <div class="detail-review-post">
                            <x-markdown>
                              {{ $serie['detail'] }}
                              {{ $serie['overview'] }}
                            </x-markdown>
                        </div>
                    </div>
                    <h2 class="text-main" id="trailer">{{ $serie['name'].' Trailer' }}</h2>
                    <div class="detail-trailer ratio ratio-16x9">
                        <iframe class="trailer-iframe" src="{{ 'https://www.youtube.com/embed/'.$serie['trailer'] }}" frameborder="0"></iframe>
                    </div>
                    <div class="relevant-detail bg-detail">
                        <h2 class="text-main">{{ $serie['name'].' RELEVANT SERIES' }}</h2>
                        <div class="movies-list owl-carousel owl-theme">
                          @foreach($list_series as $list_serie)
                              <div class="movies-iteam">
                                <a href="{{ url('series/'.$list_serie['slug']) }}"><img src="{{ asset('public'.$list_serie['poster']) }}" alt=""></a>
                                <div class="movies-in text-center">
                                  <span>{{ count($list_serie->seasons).' seasons' }}</span>
                                </div>
                                <div class="movies-name">
                                  <a href="">{{ $list_serie['name'] }}</a>
                                </div>
                                <div class="movies-category">
                                  @foreach( $list_serie->genres as $genre)
                                    <a href="{{url('series/'.$list_serie['slug'])}}">{{ $genre['name']}} ,</a>
                                  @endforeach
                                </div>
                              </div>
                          @endforeach    
                        </div>

                    </div>
                    <div class="detail-comment bg-detail">
                        <h2 id="comment">COMMENT</h2>
                    </div>
                
                </div>
                <!-- End movies -->
@endsection