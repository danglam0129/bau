@extends('layout.layout')
@section('title', 'Xenews | List of thousands News ')
@section('description', "News List of Xenews")
@section('canonical')
{{url()->current()}}
@endsection

@section('content')
    <!-- News -->

    <div class="wp-content bg-main3">

        <div class="container pt-3 pt-md-4">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item text-1"><a href="{{ url('/') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">News</li>
                </ol>
            </nav>
            <div class="row">
                <div class="col-md-8 col-lg-9">
                    <div class="h1 text-main h1news">NEWS</div>
                    <div class="news-page">

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
                              {{ $posts->appends($data)->links('paginate') }}
                          </ul>
                      </div>
                      <hr>
                    </div>
                    <!-- End News -->
                </div>
                
            @endsection
