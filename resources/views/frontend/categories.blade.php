@extends('frontend.layout')

@section('content')
    <body>
    <!-- News With Sidebar Start -->
    <div class="container-fluid mt-5 pt-3">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-12">
                            <div class="section-title">
                                <h4 class="m-0 text-uppercase font-weight-bold">Danh mục: {{$category->languages->first()->pivot->name}}</h4>
                            </div>
                        </div>
                        @if(count($news) == 0)
                            <div class="col-12">
                                <div class="alert alert-warning">Chúng tôi sẽ cập nhật thêm tin tức trong thời gian sắp tới</div>
                            </div>
                        @endif
                        @foreach($news as $new)
                            @php
                                $newUrl=route('home.single_new', ['id' => $new->id])
                            @endphp
                            <div class="col-lg-6">
                                <div class="position-relative mb-3">
                                    <img class="img-fluid w-100" src="{{$new->image}}" style="object-fit: cover; max-height: 300px;">
                                    <div class="bg-white border border-top-0 p-4">
                                        <div class="mb-2">
                                            @foreach($new->post_catalogues as $postCatalogue)
                                                @php
                                                    $postCatalogueUrl=route('home.single_category', ['id' => $postCatalogue->id])
                                                @endphp
                                                <a class="badge badge-primary text-uppercase font-weight-semi-bold p-2 mr-2" href="{{$postCatalogueUrl}}">{{$postCatalogue->languages->first()->pivot->name}}</a>
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
            </div>
        </div>
    </div>
    <!-- News With Sidebar End -->
    </body>
@endsection
