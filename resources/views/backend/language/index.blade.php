
@include('backend.dashboard.component.breadcrump', ['title' => $config['seo']['index']['title']])
<div class="row mt20">
  <div class="col-lg-12">
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5 class="uppercase">
              {{ $config['seo']['index']['table'] }}
            </h5>
            @include('backend.language.component.toolbox')
        </div>
        <div class="ibox-content">
          @include('backend.language.component.filter')
          @include('backend.language.component.table')
        </div>
    </div>
</div>
<script>
  // //chỉ lặp qua 1 element
  // $(document).ready(function() {
  //   var elem = document.querySelector('.js-switch');
  //   var switchery = new Switchery(elem, { color: '#1AB394' });
  // })
</script>
