@extends('layout.layout')
@section('title')
{{$serie['name']." ".$season['name'].' Online Full Movies, Full HD, English Sub'}}
@endsection
@section('description')
@if(isset($season['detail']) && !empty($season['detail']))
    {{ substr($season['detail'], 0, 150) }}
@endif
@endsection
@section('canonical')
{{url()->current()}}
@endsection
@section('content')
    <!-- movies -->

    <div class="wp-content bg-main3 detail-bg pe-1" style="background-image: linear-gradient(0, rgba(252, 252, 252, 0.055), rgba(252, 252, 252, 0.3) ), url({{ asset('public'.$serie['backdrop']) }})">
        <div class="container pt-3 pt-md-4">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item text-1"><a href="{{ url('/') }}">Home</a></li>
                    <li class="breadcrumb-item text-1"><a href="{{ url('series') }}">Series</a></li>
                    <li class="breadcrumb-item text-1"><a href="{{ url('series/'.$serie['slug']) }}">{{ $serie['name'] }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $season['name'] }} </li>
                </ol>
            </nav>
            <div class="col-12">
                <h2 class="text-main bg-detail">{{ $serie['name'].' '.$season['name'] }} EPISODE</h2>
                <div class="bg-detail row text-center ep-list">
                    @foreach($season->episodes()->get()->sortBy('name', SORT_NATURAL) as $episode)
                    <div class="col-4 col-md-3 col-lg-2 py-2">
                        <a class="ep-item" href="{{ url('series/').$episode['slug'].'/watch' }}"> {{ $episode['name'] }}</a>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-5 col-lg-5 detail-c1 text-center mt-2 p-0">
                    <img class="h-100" src="{{ asset('public'.$serie['backdrop']) }}"
                        alt="">
                </div>
                <div class="col-12 col-md-7 col-lg-7 px-2 bg-detail">
                    <h1>{{ $serie['name']}} {{ $season['name'] }}</h1>
                    <div class="row pt-2">
                        <div class="col-5 col-md-4">
                            <div class="score-box text-center">
                                <img class="pb-2 pe-2" src="{{asset('image/star-fill.svg')}}" alt="">{{ $serie['rate'] }}
                            </div>
                        </div>
                    </div>
                    <div class="detail-cate pt-2">
                        <span style="font-weight: 700">GENRES:</span>
                        @foreach ($serie->genres as $genre)
                            <a href="">{{ $genre['name'] }} ,</a>
                        @endforeach
                    </div>

                    <div class="your-rate director pt-2">
                        <span class="detail-i">DIRECTED BY: </span>{{ $serie['director'] }}
                    </div>
                    <div class="director pt-2">
                        <span class="detail-i">COUNTRY: </span> {{ $serie->countries['0']['name'] }}
                    </div>
                    <div class="row d-block pt-2">
                        <span class="detail-i">PUBLISH IN: </span>{{ $serie['year'] }}
                        <span class="detail-i">DURATION: </span> {{ count($season->episodes) }} Episodes
                    </div>
                    <div class="detail-tag pt-2">
                        <span class="detail-i">TAG:</span>
                    </div>

                    <div class="row justify-content-around pb-2">
                        <a href="#review" class="d-block w-25"><button class="filter-btn w-100"> REVIEW </button></a>
                        <a href="#comment" class="d-block w-25"><button class="cmt-btn w-100">COMMENT</button></a>
                        <a href="#share" class="d-block w-25"><button class="share-btn w-100">SHARE</button></a>
                    </div>

                </div>

            </div>
            <div class="row">
                <div class="col-md-8 col-lg-9">
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
                        <h2 class="text-main ps-2">{{ $serie['name'] . ' Stars' }}</h2>
                        <div class="detail-star-list owl-carousel owl-theme">
                            @foreach ($serie->stars as $star)
                                <div class="detail-star-item">
                                    <a href="{{ url('stars/' . $star['slug']) }}"><img class="rounded-circle"
                                            src="{{ asset('public' . $star['poster']) }}"
                                            alt="{{ $star['name'] . ' poster' }}"></a>
                                    <a class="star-name d-block text-center" href="">
                                        <h5 class="no-wrap">{{ $star['name'] }}</h5>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="detail-review bg-detail">
                        <h2 class="text-main ps-2" id="review">{{ $serie['name'] . ' Review' }}</h2>
                        <div class="detail-review-post">
                            <x-markdown>
                                {{ $serie['detail'] }}
                                {{$serie['overview']}}
                            </x-markdown>
                        </div>
                    </div>
                    <h2 class="text-main" id="trailer">{{ $serie['name'] . ' Trailer' }}</h2>
                    <div class="detail-trailer ratio ratio-16x9">
                        <iframe class="trailer-iframe" src="{{ 'https://www.youtube.com/embed/' . $serie['trailer'] }}"
                            frameborder="0"></iframe>
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
