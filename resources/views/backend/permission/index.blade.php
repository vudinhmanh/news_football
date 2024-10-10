
@include('backend.dashboard.component.breadcrump', ['title' => $config['seo']['index']['title']])
<div class="row mt20">
  <div class="col-lg-12">
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5 class="uppercase">
              {{ $config['seo']['index']['table'] }}
            </h5>
        </div>
        <div class="ibox-content">
          @include('backend.permission.component.filter')
          @include('backend.permission.component.table')
        </div>
    </div>
</div>
