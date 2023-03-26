@extends('layout.layout')
@section('title')
{{'Stars List'}} 
@endsection
@section('canonical')
{{url()->current()}}
@endsection
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
                    <h1>Stars List</h1>
                    <div class="filter">
                        <form action="{{route('stars')}}" method="get">
                            <div class="row">
                                <div class="opti col-5 col-lg-3">
                                    <select class="option w-100" name="Country" id="">
                                        <option value="">Country</option>
                                        @foreach($countries as $country)
                                        <option value="{{ $country['name'] }}">{{ $country['name'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="opti col-5 col-lg-3">
                                    <select class="option w-100" name="Gender" id="">
                                        <option value="">Gender</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
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
                            @foreach($stars as $star)
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
                    </div>
                    <div class="paginate">
                        <ul>
                            {{ $stars->links('paginate') }}
                        </ul>
                    </div>


                </div>
                <!-- End Stars -->
@endsection