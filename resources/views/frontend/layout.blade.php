<!DOCTYPE html>
<html lang="en">

@include('frontend.components.head')
@include('frontend.components.topbar')
@include('frontend.components.navbar')
@yield('content')
<!-- Footer Start -->
@include('frontend.components.footer')
<!-- Footer End -->
<!-- Back to Top -->
@include('frontend.components.back_to_top')
@include('frontend.components.scripts')
</html>
