@extends('frontend.layout')

@section('content')
    <body>
    <!-- Main News Slider Start -->
    <div class="container-fluid">
        <div class="">
            <div class="row">
                <div class="col-lg-12 px-0">
                    <div class="owl-carousel main-carousel position-relative">
                        @foreach($breaking_news as $new)
                            @php
                                $newUrl = route('home.single_new', ['id' => $new->id])
                            @endphp
                            <div class="position-relative overflow-hidden" style="height: 500px;">
                                <img class="img-fluid h-100" src="{{$new->image}}" style="object-fit: cover;">
                                <div class="overlay">
                                    <div class="mb-2">
                                        @foreach($new->post_catalogues as $category)
                                            @php
                                                $categoryUrl = route('home.single_category', ['id' => $category->id])
                                            @endphp
                                            <a class="badge badge-primary text-uppercase font-weight-semi-bold p-2 mr-2" href="{{$categoryUrl}}">{{$category->languages->first()->pivot->name}}</a>
                                        @endforeach
                                        <a class="text-white" href="{{$newUrl}}">{{$new->created_at->format('M d, Y')}}</a>
                                    </div>
                                    <a class="h2 m-0 text-white text-uppercase font-weight-bold" href="{{$newUrl}}">{{$new->languages->first()->pivot->name}}</a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Main News Slider End -->
    <!-- Breaking News Start -->
    <div class="container-fluid bg-dark py-3 mb-3">
        <div class="container">
            <div class="row align-items-center bg-dark">
                <div class="col-12">
                    <div class="d-flex justify-content-between">
                        <div class="bg-primary text-dark text-center font-weight-medium py-2" style="width: 170px;">Tin xem nhiều nhất</div>
                        <div class="owl-carousel tranding-carousel position-relative d-inline-flex align-items-center ml-3"
                             style="width: calc(100% - 170px); padding-right: 90px;">
                            @foreach($breaking_news as $new)
                                @php
                                    $newUrl=route('home.single_new', ['id' => $new->id])
                                @endphp
                                <div class="text-truncate"><a class="text-white text-uppercase font-weight-semi-bold" href="{{$newUrl}}">{{$new->languages->first()->pivot->name}}</a></div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breaking News End -->


    <!-- Featured News Slider Start -->
    <div class="container-fluid pt-5 mb-3">
        <div class="container">
            <div class="section-title">
                <h4 class="m-0 text-uppercase font-weight-bold">Tin tức nổi bật</h4>
            </div>
            <div class="owl-carousel news-carousel carousel-item-4 position-relative">
                @foreach($featured_news as $new)
                    @php
                        $newUrl = route('home.single_new', ['id' => $new->id])
                    @endphp
                    <div class="position-relative overflow-hidden" style="height: 300px;">
                        <img class="img-fluid h-100" src="{{$new->image}}" style="object-fit: cover;">
                        <div class="overlay">
                            <div class="mb-2">
                                @foreach($new->post_catalogues as $category)
                                    @php
                                        $categoryUrl = route('home.single_category', ['id' => $category->id])
                                    @endphp
                                    <a class="badge badge-primary text-uppercase font-weight-semi-bold p-2 mr-2 mt-2" href="{{$newUrl}}">{{$category->languages->first()->pivot->name}}</a><br>
                                @endforeach
                                <a class="text-white" href="{{$newUrl}}"><small>{{$new->created_at->format('M d, Y')}}</small></a>
                            </div>
                            <a class="h6 m-0 text-white text-uppercase font-weight-semi-bold ellipsis-text d-block" href="{{$newUrl}}" style="width: inherit;">{{$new->languages->first()->pivot->name}}</a>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-12">
                            <div class="section-title">
                                <h4 class="m-0 text-uppercase font-weight-bold">Tin tức mới nhất</h4>
                            </div>
                        </div>
                        @foreach($latest_news as $new)
                            @php
                                $newUrl=route('home.single_new', ['id' => $new->id])
                            @endphp
                            <div class="col-lg-6">
                                <div class="position-relative mb-3">
                                    <img class="img-fluid w-100" src="{{$new->image}}" style="object-fit: cover; max-height: 300px;">
                                    <div class="bg-white border border-top-0 p-4">
                                        <div class="mb-2">
                                            @foreach($new->post_catalogues as $category)
                                                @php
                                                    $categoryUrl = route('home.single_category', ['id' => $category->id])
                                                @endphp
                                                <a class="badge badge-primary text-uppercase font-weight-semi-bold p-2 mr-2" href="{{$categoryUrl}}">{{$category->languages->first()->pivot->name}}</a>
                                            @endforeach
                                            <a class="text-body" href="{{$newUrl}}"><small>{{$new->created_at->format('M d, Y')}}</small></a>
                                        </div>
                                        <a class="h4 d-block mb-3 text-secondary text-uppercase font-weight-bold ellipsis-text" href="{{$newUrl}}">{{$new->languages->first()->pivot->name}}</a>
                                        <div class="m-0 d-block ellipsis-text">
                                            {!!$new->languages->first()->pivot->description!!}
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-between bg-white border border-top-0 p-4">
                                        <div class="d-flex align-items-center">
                                            {{--                                            <img class="rounded-circle mr-2" src="img/user.jpg" width="25" height="25" alt="">--}}
                                            <small>{{$new->user->name}}</small>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <small class="ml-3"><i class="far fa-eye mr-2"></i>{{$new->n_views}}</small>
                                            <small class="ml-3"><i class="far fa-comment mr-2"></i>{{$new->n_comments}}</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-lg-4">
                   
                </div>
            </div>
        </div>
    </div>
    </body>
@endsection
