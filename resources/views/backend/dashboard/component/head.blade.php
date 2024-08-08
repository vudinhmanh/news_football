<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Admin | M-Shop</title>
<script src="/Admin/js/jquery-3.1.1.min.js"></script>
<link href="/Admin/css/bootstrap.min.css" rel="stylesheet">
<link href="/Admin/font-awesome/css/font-awesome.css" rel="stylesheet">
@vite('resources/css/app.css')
<link href="/Admin/css/animate.css" rel="stylesheet">
<link href="/Admin/css/style.css" rel="stylesheet">
<link href="/Admin/css/custom.css" rel="stylesheet">


@if (isset($config['css']) && is_array($config['css']))
  @foreach($config['css'] as $key => $val)
    {!! '<link rel="stylesheet" href="'.$val.'"></script>' !!}    
  @endforeach
@endif