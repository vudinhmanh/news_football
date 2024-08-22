<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
</head>
<body>
  @include('backend.dashboard.component.breadcrump', ['title' => $config['seo']['index']['title']])
  <div class="row mt20">
    <div class="col-lg-12">
      <div class="ibox float-e-margins">
          <div class="ibox-title">
              <h5 class="uppercase">
                {{ $config['seo']['index']['table'] }}
              </h5>
              @include('backend.user.catalogue.component.toolbox')
          </div>
          <div class="ibox-content">
            @include('backend.user.catalogue.component.filter')
            @include('backend.user.catalogue.component.table')
          </div>
      </div>
  </div>
</body>
<script>
  // //chỉ lặp qua 1 element
  // $(document).ready(function() {
  //   var elem = document.querySelector('.js-switch');
  //   var switchery = new Switchery(elem, { color: '#1AB394' });
  // })
</script>
</html>