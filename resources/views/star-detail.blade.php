@extends('layout.layout')
@section('title')
{{$star['name'].' Bio, News, Movies, Series'}}
@endsection
@section('description')
@if(isset($star['bio']) && !empty($star['bio']))
    {{ substr($star['bio'], 0, 150) }}
@endif
@endsection
@section('canonical')
{{url()->current()}}
@endsection
@section('content')
    <!-- movies -->

    <div class="wp-content bg-main3 detail-bg">
        <div class="container pt-3 pt-md-4">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item text-1"><a href="{{ url('/') }}">Home</a></li>
                    <li class="breadcrumb-item text-1"><a href="{{ url('stars') }}">Stars</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $star['name'] }}</li>
                </ol>
            </nav>

            <div class="wp-content row p-0 ">
                <div class="col-md-8 col-lg-9">
                    <div class="row">
                        <div class="col-12 col-md-5 col-lg-4 detail-c1 text-center">
                            <img class="main-detail-img" src="{{ asset('public') . $star['poster'] }}" alt="">

                        </div>
                        <div class="col-12 col-md-7 col-lg-8 px-2 bg-detail">
                            <h1>{{ $star['name'] }}</h1>
                            <div class="detail-cate pt-2">
                                <span style="font-weight: 700">GENDER:</span>
                                {{ $star['gender'] }}
                            </div>
                            <div class="pt-2">
                                <span class="detail-i">COUNTRY: </span> {{ $star['place'] }}
                            </div>
                            <div class="pt-2">
                                <span>Date of Birth:</span> {{ $star['birthday'] }}
                            </div>
                            <div class="pt-2">
                                <span>JOB:</span> {{ $star['job'] }}
                            </div>
                            <div class="detail-tag pt-2">
                                <span class="detail-i">TAG:</span>
                            </div>

                            <div class="row justify-content-around pb-2">
                                <a href="#bio" class="d-block w-25"><button class="filter-btn w-100"> BIO </button></a>
                                <a href="#share" class="d-block w-25"><button class="share-btn w-100">SHARE</button></a>
                            </div>

                        </div>
                    </div>

                    <div class="detail-review bg-detail">
                        <h2>REVIEW</h2>
                        <div class="detail-review-post">
                            {{ $star['bio'] }}
                        </div>
                    </div>
                    <div class="relevant-detail bg-detail">
                        <h2>{{ $star['name'] }} MOVIES</h2>
                        <div class="movies-list owl-carousel owl-theme">
                            @foreach ($star->movies as $movie)
                                <div class="movies-iteam">
                                    <a href="{{ url('movies/'.$movie['slug'])  }}"><img
                                            src="{{ asset('public') . $movie['poster'] }}"
                                            alt="{{ $movie['name'] . ' poster' }}"></a>
                                    <div class="movies-in text-center">
                                        <span>{{ $movie['time'] }} mins</span>
                                    </div>
                                    <div class="movies-name">
                                        <a href="">{{ $movie['name'] }}</a>
                                    </div>
                                    <div class="movies-category">
                                        @foreach ($movie->genres as $genre)
                                            <a href="{{ url('movies/'.$movie['slug']) }}">{{ $genre['name'] }} ,</a>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="relevant-detail bg-detail">
                      <h2>{{ $star['name'] }} SERIES</h2>
                      <div class="movies-list owl-carousel owl-theme">
                          @foreach ($star->series as $serie)
                              <div class="movies-iteam">
                                  <a href="{{ url('series/'.$serie['slug']) }}"><img
                                          src="{{ asset('public') . $serie['poster'] }}"
                                          alt="{{ $serie['name'] . ' poster' }}"></a>
                                  <div class="movies-in text-center">
                                      <span>{{ $serie['time'] }} mins</span>
                                  </div>
                                  <div class="movies-name">
                                      <a href="">{{ $serie['name'] }}</a>
                                  </div>
                                  <div class="movies-category">
                                      @foreach ($serie->genres as $genre)
                                          <a href="{{ url('series/'.$serie['slug']) }}">{{ $genre['name'] }} ,</a>
                                      @endforeach
                                  </div>
                              </div>
                          @endforeach
                      </div>
                  </div>
                  <h2 class="text-main">RELEATED POST</h2>
                    @foreach ($posts as $post )
                    <div class="news-iteam bg-dark">
                        <div class="row h-100">
                            <div class="col-5 col-md-5 col-xl-4 pl0 d-flex align-items-center h-100">
                                <a href="{{ url($post['slug']) }}" class="h-100 w-100 d-block text-center"><img class="news-image"
                                        src="{{ asset('image/'.$post['link']) }}"
                                        alt="{{ $post['title'].' image' }}"></a>
                            </div>
                            <div class="col-7 col-md-7 col-xl-8 pt-2">
                                <div class="h4 no-wrap"><a class="h4title"
                                        href="{{ url($post['slug']) }}">{{ $post['title'] }}</a></div>
                                <div class="row mb-2">
                                    <div class="col-6 col-lg-2 newscategory">
                                        <a href="{{ url('news') }}">News</a>
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
                    <div class="detail-comment bg-detail">
                        <h2>COMMENT</h2>
                    </div>

                </div>
                <!-- End movies -->
            @endsection
