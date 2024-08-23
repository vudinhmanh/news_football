<!-- Mainly scripts -->
<script src="/Admin/js/jquery-3.1.1.min.js"></script>
<script src="/Admin/js/bootstrap.min.js"></script>
<script src="/Admin/js/plugins/metisMenu/jquery.metisMenu.js"></script>
<script src="/Admin/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
<script src="/Admin/library/library.js"></script>
<!-- jQuery UI -->
<script src="/Admin/js/plugins/jquery-ui/jquery-ui.min.js"></script>
<script src="/Admin/js/inspinia.js"></script>
<script src="/Admin/js/plugins/pace/pace.min.js"></script>

@if (isset($config['js']) && is_array($config['js']))
  @foreach($config['js'] as $key => $val)
    {!! '<script src="'.$val.'"></script>' !!}    
  @endforeach
@endif
