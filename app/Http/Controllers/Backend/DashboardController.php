<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function __construct()
    {

    }    
    public function index() {
        $config = $this->config();
        // echo "da dang nhap";
        $template = 'backend.dashboard.home.index';
        return view("backend.dashboard.layout", compact(
            'template',
            'config'
        ));
    }
    public function config() {
        return 
        [
            'js' => [
                '/Admin/js/plugins/flot/jquery.flot.js',
                '/Admin/js/plugins/flot/jquery.flot.tooltip.min.js',
                '/Admin/js/plugins/flot/jquery.flot.spline.js',
                '/Admin/js/plugins/flot/jquery.flot.resize.js',
                '/Admin/js/plugins/flot/jquery.flot.pie.js',
                '/Admin/js/plugins/flot/jquery.flot.symbol.js',
                '/Admin/js/plugins/flot/jquery.flot.time.js',
                '/Admin/js/plugins/peity/jquery.peity.min.js',
                '/Admin/js/demo/peity-demo.js',
                '/Admin/js/inspinia.js',
                '/Admin/js/plugins/pace/pace.min.js',
                '/Admin/js/plugins/jvectormap/jquery-jvectormap-2.0.2.min.js',
                '/Admin/js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js',
                '/Admin/js/plugins/easypiechart/jquery.easypiechart.js',
                '/Admin/js/plugins/sparkline/jquery.sparkline.min.js',
                '/Admin/js/demo/sparkline-demo.js'
            ]
        ];
    }
}
