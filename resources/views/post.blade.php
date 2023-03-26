@extends('layout.layout')
@section('title')
{{$post['title']}}
@endsection
@section('canonical')
{{url()->current()}}
@endsection
@section('content')
    <div class="wp-content bg-main3">
        <div class="container pt-3 pt-md-4">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item text-1"><a href="{{ url('/') }}">Home</a></li>
                    <li class="breadcrumb-item text-1"><a href="{{ url('news') }}">News</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $post['title'] }}</li>
                </ol>
            </nav>
            <div class="row">
                <div class="col-md-8 col-lg-9">
                    <h1>{{ $post['title'] }}</h1>
                    <div class="post-info col-lg-6">
                        <div class="newscategory">
                            <a href="">News</a>
                        </div>
                        <div class="news-author">
                            <a href="">Admin</a>
                        </div>
                        <div class="newstime">
                            {{ $post['date'] }}
                        </div>
                        <div class="newscmt">
                            <img src="{{ asset('image/chat-left-text-fill.svg') }}" alt="">
                            <span>22</span>
                        </div>
                    </div>
                    <div class="wp-post">
                        <img class="w-100 border-10" src="{{ asset('image/'.$post['link']) }}"
                            alt="">
                        <div class="post-content">
                               {!! $post['content'] !!}
                        </div>
                    </div>

                    <h2 class="text-main">RELEATED POST</h2>
                    @foreach ( $postss as $posts )
                    <div class="news-iteam bg-dark">
                        <div class="row h-100">
                            <div class="col-5 col-md-5 col-xl-4 pl0 d-flex align-items-center h-100">
                                <a href="{{ url($posts['slug']) }}" class="h-100 w-100 d-block text-center"><img class="news-image"
                                        src="{{ asset('image/'.$posts['link']) }}"
                                        alt="{{ $posts['title'].' image' }}"></a>
                            </div>
                            <div class="col-7 col-md-7 col-xl-8 pt-2">
                                <div class="h4 no-wrap"><a class="h4title"
                                        href="{{ url($posts['slug']) }}">{{ $posts['title'] }}</a></div>
                                <div class="row mb-2">
                                    <div class="col-6 col-lg-2 newscategory">
                                        <a href="#">News</a>
                                    </div>
                                    <div class="col-6 col-lg-3 news-author">
                                        <a href="{{ url($posts['slug']) }}">Admin</a>
                                    </div>
                                    <div class="newstime col-7 col-lg-5">
                                        {{ $posts['date'] }}
                                    </div>
                                    <div class="col-5 col-lg-2 newscmt">
                                        <img src="{{ asset('image/chat-left-text-fill.svg') }}" alt="">
                                        <span>16</span>
                                    </div>
                                </div>
                                <div class="news-description">
                                    <x-markdown>
                                        {{ substr(strip_tags($posts['content']), 0, 300) }}
                                    </x-markdown>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    <hr>
                    <!-- End Post -->
                </div>
@endsection
