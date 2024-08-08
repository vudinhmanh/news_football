<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
</head>
<body>

  <div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-8">
      <h2>{{ config('apps.user.title') }}</h2>
      <ol class="breadcrumb" style="margin-bottom: 10px;">
        <li>
          <a href="">Dashboard</a>
        </li>
        <li class="active">
          <strong>{{ config('apps.user.title') }}</strong>
        </li>
      </ol>
    </div>
  </div>

  <div class="row mt20">
    <div class="col-lg-12">
      <div class="ibox float-e-margins">
          <div class="ibox-title">
              <h5 class="uppercase">Danh sách thành viên</h5>
              @include('backend.user.component.toolbox')
          </div>
          <div class="ibox-content">
            @include('backend.user.component.filter')
            @include('backend.user.component.table')
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