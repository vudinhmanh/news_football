<div class="container-fluid d-none d-lg-block">
    <div class="row align-items-center bg-dark px-lg-5">
        <div class="col-lg-12 row" style="justify-content: end">
            <nav class="navbar navbar-expand-sm bg-dark p-0">
                <ul class="navbar-nav ml-n2">
                    @if(empty(auth()->user()))
                        <li class="nav-item">
                            <a class="nav-link text-body small" href="{{route('home.login')}}">Đăng nhập với Google</a>
                        </li>
                    @else
                        <li class="nav-item">
                            <span class="nav-link text-body small nav-item dropdown">
                                Xin chào <b>{{auth()->user()->name}}</b>
                                <div class="dropdown-menu rounded-0 m-0">
                                    <a href="{{route('home.profile')}}" class="dropdown-item nav-link text-body small">Thông tin cá nhân</a>
                                    <a class="dropdown-item nav-link text-body small" href="{{route('home.logout')}}">Đăng xuất</a>
                                </div>
                            </span>
                        </li>
                    @endif
                </ul>
            </nav>
        </div>
    </div>
    <div class="row align-items-center bg-white py-3 px-lg-5">
        <div class="col-lg-4">
            <a href="{{route('home.index')}}" class="navbar-brand p-0 d-none d-lg-block">
                <h1 class="m-0 display-4 text-uppercase text-primary">Tin Tức<span class="mx-3 text-secondary font-weight-normal">Thể Thao</span></h1>
            </a>
        </div>
    </div>
</div>
