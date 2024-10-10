<div class="row wrapper border-bottom white-bg page-heading">
  <div class="col-lg-8">
    <h2 class="mt-4">{{ $title }}</h2>
    <ol class="breadcrumb" style="margin-bottom: 10px;">
      <li class="mt-2">
        <a href="{{route('admin.dashboard')}}">
          {{__('messages.Dashboard') }}
        </a>
      </li>
      <li class="active">
        <strong>{{ $title }}</strong>
      </li>
    </ol>
  </div>
</div>
