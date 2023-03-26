@extends('layout.layout')
@section('title', 'Xenews | List of thousands Online Free HD Series and Episodes ')
@section('description', "Watch thousands Series and Episodes online, fast, free, full hd, full subtitle on Xenews")
@section('canonical')
{{url()->current()}}
@endsection
@section('content')
    <!-- Stars -->

    <div class="wp-content bg-main3">

        <div class="container pt-3 pt-md-4">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item text-1"><a href="{{ url('/') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Series</li>
                </ol>
            </nav>
            <div class="row">
                <div class="col-md-8 col-lg-9">
                    <h1>Series List</h1>
                    <div class="filter ">
                        
                            <form action="{{route('series')}}" method="get">
                                <div class="row">
                                    <div class="opti col-5 col-lg-3">
                                        <select class="option w-100" name="Genres" id="">
                                            <option value="">Genres</option>
                                            @foreach($genres as $genre)
                                            <option value="{{ $genre['name'] }}">{{ $genre['name'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="opti col-5 col-lg-3">
                                        <select class="option w-100" name="Country" id="">
                                            <option value="">Country</option>
                                            @foreach($countries as $country)
                                            <option value="{{ $country['name'] }}">{{ $country['name'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="opti col-5 col-lg-3">
                                        <select class="option w-100" name="Year" id="">
                                            <option value="">Year</option>
                                            @for($t=1950; $t<2025; $t++)
                                            <option value="{{ $t }}">{{ $t }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                   
                                    <div class="col-3 col-lg-2">
                                        <button class="filter-btn w-100">FIND</button>
                                    </div>
                                </div>
                            </form>
                        
                        
                    </div>
                    <div class="star-list">
                        <div class="row">
                            @foreach ($series as $serie )
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
                    </div>
                    <div class="paginate">
                        <ul>
                            {{ $series->appends($data)->links('paginate') }}
                        </ul>
                    </div>
                    <hr>


                </div>
                <!-- End Stars -->
            @endsection
