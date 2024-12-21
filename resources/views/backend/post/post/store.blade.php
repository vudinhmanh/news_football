@if (strpos(url()->current(), 'edit') !== false)
    @include('backend.dashboard.component.breadcrump', ['title' => $config['seo']['edit']['title']])
@else
    @include('backend.dashboard.component.breadcrump', ['title' => $config['seo']['create']['title']])
@endif
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@php
    $url = ($config['method'] == 'create' ? route('post.store') : route('post.update', $post->id));
@endphp
<form action="{{ $url }}" method="post" class="box">
  @csrf
  <div class="wrapper wrapper-content animated fadeInRight">
      <div class="row">
          <div class="col-lg-8">
            <div class="ibox">
                <div class="ibox-title">
                    <h5>{{__('messages.post.index.title') }}</h5>
                    
                </div>
                <div class="ibox-content">
                    @include('backend.post.post.component.general')
                </div>
            </div>
            {{-- @include('backend.post.post.component.seo') --}}
          </div>
          <div class="col-lg-4">
            @include('backend.post.post.component.aside')
          </div>
      </div>
      <hr>
      <div class="text-right">
          <button class="btn btn-primary" type="submit" name="send" value="send">Lưu lại</button>
      </div>
  </div>
</form>