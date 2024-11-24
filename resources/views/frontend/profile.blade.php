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
                                <h4 class="m-0 text-uppercase font-weight-bold">Thông tin cá nhân</h4>
                            </div>
                        </div>
                        <div class="col-12">
                            <form action="{{route('home.edit_profile')}}" method="POST">
                                @csrf
                                @php
                                    $user = auth()->user();
                                @endphp
                                <div class="row">
                                    <div class="form-group col-6">
                                        <label for="name">Tên</label>
                                        <input type="text" class="form-control" id="name" name="name" value="{{$user->name}}">
                                    </div>
                                    <div class="form-group col-6">
                                        <label for="name">Số điện thoại</label>
                                        <input type="text" class="form-control" id="phone" name="phone" value="{{$user->phone}}">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-6">
                                        <label for="name">Địa chỉ</label>
                                        <input type="text" class="form-control" id="address" name="address" value="{{$user->address}}">
                                    </div>
                                    <div class="form-group col-6">
                                        <label for="name">Ngày sinh</label>
                                        <input type="date" class="form-control" id="birthday" name="birthday" value="{{$user->stringBirthday()}}">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-6 my-2">
                                        <input type="submit" value="Cập nhật" class="btn btn-primary font-weight-semi-bold py-2 px-3">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="section-title">
                                <h4 class="m-0 text-uppercase font-weight-bold">Tin tức đã lưu</h4>
                            </div>
                        </div>
                        @if(count($user->saved_posts) == 0)
                            <div class="col-12">
                                <div class="alert alert-warning">Bạn chưa lưu tin tức nào</div>
                            </div>
                        @endif
                        @foreach($user->saved_posts as $new)
                            @php
                                $newUrl = route('home.single_new', ['id' => $new->id])
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
                                        <form action="{{route('home.save_post')}}" method="POST" class="mt-2">
                                            @csrf
                                            <input type="hidden" name="post_id" value="{{$new->id}}">
                                            <div class="form-group mb-0">
                                                <input type="submit" value="Bỏ lưu tin tức" class="btn btn-primary font-weight-semi-bold py-2 px-3">
                                            </div>
                                        </form>
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
