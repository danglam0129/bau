    <!-- Header -->
    <header>
        <div class="container-fluid bg-header h80px fixed-top p-0 ">
            <div class="row h80px m-0 gutter-0">
                <div class="col-4 col-lg-2 p-0 d-flex align-items-center justify-content-center">
                    <a class="d-flex justify-content-center align-items-center" href="{{ url('/') }}"><img class="w-75 logoheight"
                            src="{{ asset('image/logo.png') }}" alt=""></a>
                </div>
                <div class="col-7 col-lg-4 order-lg-3 d-flex align-items-center justify-content-center">
                    <form action="{{route('search')}}" method="get" class="w-100 h-85 position-relative d-flex align-items-center">
                        <input type="hidden" name="_token" value="{{csrf_token()}}";>
                        <input type="text" class="h-85 w-80 border40 border border-0 bg-search inputpad" name="q" placeholder="Search for Movie, Series, News ...">
                        <button
                            class="border border-0 bg-transparent pab d-flex justify-content-center align-items-center">
                            <img class="h20px" src="{{ asset('image/search.svg') }}" alt="">
                        </button>
                    </form>
                </div>
                <div class="col-1 order-lg-4 d-flex justify-content-start align-items-center p-0">
                    <a class="d-flex justify-content-start align-items-center" href="#"><img class="w-75"
                            src="{{ asset('image/person-circle.svg') }}" alt=""></a>
                </div>
                <div class="col-12 col-lg-5 p-0">
                    <nav class="h-100">
                        <ul class="d-flex justify-content-around align-items-center m-0 h-100 p-1">
                            <li class="list-inline-item ">
                                <a href="{{ url('/') }}" class="text-decoration-none">Home</a>
                            </li>
                            <li class="list-inline-item ">
                                <a href="{{ url('/news') }}" class="text-decoration-none">News</a>
                            </li>
                            <li class="list-inline-item ">
                                <a href="{{ url('/stars') }}" class="text-decoration-none">Stars</a>
                            </li>
                            <li class="list-inline-item ">
                                <a href="{{ url('/movies') }}" class="text-decoration-none">Movies</a>
                            </li>
                            <li class="list-inline-item ">
                                <a href="{{ url('/series') }}" class="text-decoration-none">Series</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </header>
    <!-- End Header  -->