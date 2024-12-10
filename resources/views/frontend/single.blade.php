@extends('frontend.layout')

@section('content')
    <style>
        p > img{
            width: 100%; 
            height: auto; 
            display: block; 
        }
        .bg-white img {
            max-width: 100%;
            height: auto;
            display: block;
            margin: 0 auto;
        }
    </style>
    <body>
    <div class="container-fluid">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <!-- News Detail Start -->
                    <div class="position-relative mb-3">
                        {{-- <img class="img-fluid w-100" src="{{$new->image}}" style="object-fit: cover;"> --}}
                        <div class="bg-white border border-top-0 p-4" style="word-wrap: break-word;">
                            <div class="mb-3">
                                @foreach($new->post_catalogues as $category)
                                    @php
                                        $categoryUrl=route('home.single_category', ['id' => $category->id])
                                    @endphp
                                    <a class="badge badge-primary text-uppercase font-weight-semi-bold p-2 mr-2" href="{{$categoryUrl}}">{{$category->languages->first()->pivot->name}}</a>
                                @endforeach
                                <a class="text-body" href="">{{$new->created_at->format('M d, Y')}}</a>
                            </div>
                            <h1 class="mb-3 text-secondary text-uppercase font-weight-bold">
                                {{$new->languages->first()->pivot->name}}
                            </h1>
                            {!! $new->languages->first()->pivot->description !!}
                            {!! $new->languages->first()->pivot->content !!}
                            @if(auth()->user())
                                <form action="{{route('home.save_post')}}" method="POST" class="mt-2">
                                    @csrf
                                    <input type="hidden" name="post_id" value="{{$new->id}}">
                                    <div class="form-group mb-0">
                                        <input type="submit" value="@if($my_save_post) Bỏ lưu tin tức @else Lưu tin tức @endif" class="btn btn-primary font-weight-semi-bold py-2 px-3">
                                    </div>
                                </form>
                            @endif
                        </div>
                        <div class="d-flex justify-content-between bg-white border border-top-0 p-4">
                            <div class="d-flex align-items-center">
                                {{--                                <img class="rounded-circle mr-2" src="img/user.jpg" width="25" height="25" alt="">--}}
                                <span>Tác giả: {{$new->user->name}}</span>
                            </div>
                            {{--                            <div class="d-flex align-items-center">--}}
                            {{--                                <span class="ml-3"><i class="far fa-eye mr-2"></i>12345</span>--}}
                            {{--                                <span class="ml-3"><i class="far fa-comment mr-2"></i>123</span>--}}
                            {{--                            </div>--}}
                        </div>
                    </div>
                    <!-- News Detail End -->

                    <!-- Comment List Start -->
                    <div class="mb-3">
                        <div class="section-title mb-0">
                            <h4 class="m-0 text-uppercase font-weight-bold">{{$new->n_comments}} bình luận</h4>
                        </div>
                        <div class="bg-white border border-top-0 p-4">
                            @foreach($new->comments as $comment)
                                @php
                                    $commenter_name = $comment->user->name;
                                    $my_comment = false;
                                    if (auth()->user() && $comment->user->id == auth()->user()->id) {
                                        $commenter_name = 'Bạn';
                                        $my_comment = true;
                                    }
                                @endphp
                                <div class="media mb-1 p-2" style="@if($my_comment) background-color: #ffcc00; @endif">
                                    <div class="media-body">
                                        <h6><a class="text-secondary font-weight-bold" href="">{{$commenter_name}}</a> <small><i>{{$comment->created_at->format('d M Y')}}</i></small></h6>
                                        <p>{{$comment->content}}</p>
                                        @if($my_comment)
                                            <form action="{{route('home.delete_comment', ['id' => $comment->id])}}" method="POST">
                                                @csrf
                                                <input type="submit" value="Xóa" class="">
                                            </form>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <!-- Comment List End -->

                    <!-- Comment Form Start -->
                    @if(auth()->user())
                        <div class="mb-3">
                            <div class="section-title mb-0">
                                <h4 class="m-0 text-uppercase font-weight-bold">Để lại bình luận của bạn</h4>
                            </div>
                            <div class="bg-white border border-top-0 p-4">
                                <form action="{{route('home.comment')}}" method="POST">
                                    @csrf
                                    <input type="hidden" name="post_id" value="{{$new->id}}">
                                    <div class="form-group">
                                        <label for="message">Nội dung *</label>
                                        <textarea id="message" cols="30" rows="5" class="form-control" name="content"></textarea>
                                    </div>
                                    <div class="form-group mb-0">
                                        <input type="submit" value="Gửi bình luận" class="btn btn-primary font-weight-semi-bold py-2 px-3">
                                    </div>
                                </form>
                            </div>
                        </div>
                    @endif
                    <!-- Comment Form End -->
                </div>
            </div>
        </div>
    </div>
    </body>
@endsection
