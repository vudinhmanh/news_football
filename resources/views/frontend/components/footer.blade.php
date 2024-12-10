<div class="container-fluid bg-dark pt-5 px-sm-3 px-md-5 mt-5">
    <div class="row py-4">
        <div class="col-lg-4 col-md-6 mb-5">
            <h5 class="mb-4 text-white text-uppercase font-weight-bold">TIN TỨC THỂ THAO</h5>
            <p class="font-weight-medium"><i class="fa fa-map-marker-alt mr-2"></i>Số 298 Đ. Cầu Diễn, Minh Khai, Bắc Từ Liêm, Hà Nội</p>
            <p class="font-weight-medium"><i class="fa fa-phone-alt mr-2"></i>0395792304</p>
            <p class="font-weight-medium"><i class="fa fa-envelope mr-2"></i>Manhmanhmanh289@gmail.com</p>
        </div>
        <div class="col-lg-4 col-md-6 mb-5">
            <h5 class="mb-4 text-white text-uppercase font-weight-bold">Tin xem nhiều nhất</h5>
            @foreach($breaking_news as $new)
                @php
                    $newUrl = route('home.single_new', ['id' => $new->id])
                @endphp
                <div class="mb-3">
                    <div class="mb-2">
                        @foreach($new->post_catalogues as $category)
                            @php
                                $categoryUrl = route('home.single_category', ['id' => $category->id])
                            @endphp
                            <a class="badge badge-primary text-uppercase font-weight-semi-bold p-2 mr-2" href="{{$categoryUrl}}">{{$category->languages->first()->pivot->name}}</a>
                        @endforeach
                        <a class="text-body" href="{{$newUrl}}"><small>{{$new->created_at->format('M d, Y')}}</small></a>
                    </div>
                    <a class="small text-body text-uppercase font-weight-medium" href="{{$newUrl}}">{{$new->languages->first()->pivot->name}}</a>
                </div>
            @endforeach
        </div>
        <div class="col-lg-3 col-md-6 mb-5">
            <h5 class="mb-4 text-white text-uppercase font-weight-bold">Tất cả danh mục</h5>
            <div class="m-n1">
                @foreach($categories as $category)
                    <a href="{{route('home.single_category', ['id' => $category->id])}}" class="btn btn-sm btn-secondary m-1">{{$category->languages->first()->pivot->name}}</a>
                    @foreach($category->childrens as $_category)
                        <a href="{{route('home.single_category', ['id' => $_category->id])}}" class="btn btn-sm btn-secondary m-1">{{$_category->languages->first()->pivot->name}}</a>
                    @endforeach
                @endforeach
            </div>
        </div>
    </div>
</div>
<div class="container-fluid py-4 px-sm-3 px-md-5" style="background: #111111;">
    <p class="m-0 text-center">&copy; <a href="{{route('home.index')}}">TIN TỨC THỂ THAO</a>
</div>
