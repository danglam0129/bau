<!-- sidebar -->
<div class="col-md-4 col-lg-3 p-0 px-1 bg-detail">
    <h2 class="h2-sidebar py-1 text-main text-center">HOT NEWS</h2>
    <div class="sidebar-list">
        @foreach ($features as $feature)
            <div class="sidebar-news-iteam">
                <div class="sidebar-news-img">
                    <a href=" {{ url($feature['slug']) }}"><img src="{{asset('image/'.$feature['link'])}}" alt="{{ $feature['altimg'] }}"></a>
                    <div class="sidebar-news-info">
                        <a class="h5title h4 d-block no-wrap" href="{{ url($feature['slug']) }}">{{ $feature['title'] }}</a>
                    </div>
                    <div class="sideshadow"></div>
                    <div class="side-info text-center">
                        News
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <h2 class="h2-sidebar text-main pt-4 text-center">HOT MOVIES</h2>
    <div class="sidebar-list">
        @foreach ($sidemovies as $sidemovie)
        <div class="sidebar-news-iteam">
            <div class="sidebar-news-img">
                <a href="{{ url('movies/'.$sidemovie['slug']) }}"><img src="{{asset('public/'.$sidemovie['backdrop'])}}" alt="{{ $sidemovie['name'].' backdrop' }}"></a>
                <div class="sidebar-news-info">
                    <a class="h5title h4 d-block no-wrap" href="{{ url('movies/'.$sidemovie['slug']) }}">{{ $sidemovie['name'] }}</a>
                </div>
                <div class="sideshadow"></div>
                <div class="side-info text-center">
                    {{ $sidemovie['time'] }}mins
                </div>
            </div>
        </div>
        @endforeach
    </div>

</div>
<!-- End Sidebar -->
</div>
</div>
