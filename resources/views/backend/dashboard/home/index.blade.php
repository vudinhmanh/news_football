<div class="wrapper wrapper-content">
    <div class="row">
        {{--      <div class="col-lg-3">--}}
        {{--          <div class="ibox float-e-margins">--}}
        {{--              <div class="ibox-title">--}}
        {{--                  <span class="label label-success pull-right">Monthly</span>--}}
        {{--                  <h5>Income</h5>--}}
        {{--              </div>--}}
        {{--              <div class="ibox-content">--}}
        {{--                  <h1 class="no-margins">40 886,200</h1>--}}
        {{--                  <div class="stat-percent font-bold text-success">98% <i class="fa fa-bolt"></i></div>--}}
        {{--                  <small>Total income</small>--}}
        {{--              </div>--}}
        {{--          </div>--}}
        {{--      </div>--}}
        <div class="col-lg-4">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>TỔNG SỐ BÀI VIẾT</h5>
                </div>
                <div class="ibox-content">
                    <h1 class="no-margins">{{$total_posts}}</h1>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>TỔNG SỐ BÌNH LUẬN</h5>
                </div>
                <div class="ibox-content">
                    <h1 class="no-margins">{{$total_comments}}</h1>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>TỔNG SỐ LƯỢT XEM</h5>
                </div>
                <div class="ibox-content">
                    <h1 class="no-margins">{{$total_views}}</h1>
                </div>
            </div>
        </div>
        @foreach($categories as $category)
            <div class="col-lg-3">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Số bài viết về <strong>{{$category->languages->first()->pivot->name}}</strong></h5>
                    </div>
                    <div class="ibox-content">
                        <h1 class="no-margins">{{count($category->posts)}}</h1>
                    </div>
                </div>
            </div>
        @endforeach
        {{--      <div class="col-lg-3">--}}
        {{--          <div class="ibox float-e-margins">--}}
        {{--              <div class="ibox-title">--}}
        {{--                  <span class="label label-info pull-right">Annual</span>--}}
        {{--                  <h5>Orders</h5>--}}
        {{--              </div>--}}
        {{--              <div class="ibox-content">--}}
        {{--                  <h1 class="no-margins">275,800</h1>--}}
        {{--                  <div class="stat-percent font-bold text-info">20% <i class="fa fa-level-up"></i></div>--}}
        {{--                  <small>New orders</small>--}}
        {{--              </div>--}}
        {{--          </div>--}}
        {{--      </div>--}}
        {{--      <div class="col-lg-3">--}}
        {{--          <div class="ibox float-e-margins">--}}
        {{--              <div class="ibox-title">--}}
        {{--                  <span class="label label-primary pull-right">Today</span>--}}
        {{--                  <h5>visits</h5>--}}
        {{--              </div>--}}
        {{--              <div class="ibox-content">--}}
        {{--                  <h1 class="no-margins">106,120</h1>--}}
        {{--                  <div class="stat-percent font-bold text-navy">44% <i class="fa fa-level-up"></i></div>--}}
        {{--                  <small>New visits</small>--}}
        {{--              </div>--}}
        {{--          </div>--}}
        {{--      </div>--}}
        {{--      <div class="col-lg-3">--}}
        {{--          <div class="ibox float-e-margins">--}}
        {{--              <div class="ibox-title">--}}
        {{--                  <span class="label label-danger pull-right">Low value</span>--}}
        {{--                  <h5>User activity</h5>--}}
        {{--              </div>--}}
        {{--              <div class="ibox-content">--}}
        {{--                  <h1 class="no-margins">80,600</h1>--}}
        {{--                  <div class="stat-percent font-bold text-danger">38% <i class="fa fa-level-down"></i></div>--}}
        {{--                  <small>In first month</small>--}}
        {{--              </div>--}}
        {{--          </div>--}}
        {{--</div>--}}
    </div>
    <div class="row" style="display: none;">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Orders</h5>
                    <div class="pull-right">
                        <div class="btn-group">
                            <button type="button" class="btn btn-xs btn-white active">Today</button>
                            <button type="button" class="btn btn-xs btn-white">Monthly</button>
                            <button type="button" class="btn btn-xs btn-white">Annual</button>
                        </div>
                    </div>
                </div>
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-lg-9">
                            <div class="flot-chart">
                                <div class="flot-chart-content" id="flot-dashboard-chart"></div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <ul class="stat-list">
                                <li>
                                    <h2 class="no-margins">2,346</h2>
                                    <small>Total orders in period</small>
                                    <div class="stat-percent">48% <i class="fa fa-level-up text-navy"></i></div>
                                    <div class="progress progress-mini">
                                        <div style="width: 48%;" class="progress-bar"></div>
                                    </div>
                                </li>
                                <li>
                                    <h2 class="no-margins ">4,422</h2>
                                    <small>Orders in last month</small>
                                    <div class="stat-percent">60% <i class="fa fa-level-down text-navy"></i></div>
                                    <div class="progress progress-mini">
                                        <div style="width: 60%;" class="progress-bar"></div>
                                    </div>
                                </li>
                                <li>
                                    <h2 class="no-margins ">9,180</h2>
                                    <small>Monthly income from orders</small>
                                    <div class="stat-percent">22% <i class="fa fa-bolt text-navy"></i></div>
                                    <div class="progress progress-mini">
                                        <div style="width: 22%;" class="progress-bar"></div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>TOP tin tức nhiều bình luận nhất</h5>
                    <div class="ibox-tools">
                        {{--                        <a class="collapse-link">--}}
                        {{--                            <i class="fa fa-chevron-up"></i>--}}
                        {{--                        </a>--}}
                        {{--                      <a class="close-link">--}}
                        {{--                          <i class="fa fa-times"></i>--}}
                        {{--                      </a>--}}
                    </div>
                </div>
                {{--              <div class="ibox-content ibox-heading">--}}
                {{--                  <h3><i class="fa fa-envelope-o"></i> New messages</h3>--}}
                {{--                  <small><i class="fa fa-tim"></i> You have 22 new messages and 16 waiting in draft folder.</small>--}}
                {{--              </div>--}}
                <div class="ibox-content">
                    <div class="feed-activity-list">
                        @foreach($top_comment_posts as $post)
                            <div class="feed-element">
                                <div>
                                    <small class="pull-right text-navy">{{$post->created_at->format('M d, Y')}}</small>
                                    <strong>{{$post->user->name}}</strong>
                                    <br>
                                    <a href="{{route('post.edit', ['id' => $post->id])}}" class="text-[#99c3ff] font-semibold text-[14px]">{{$post->languages->first()->pivot->name}}</a>
                                </div>
                            </div>
                        @endforeach


                        {{--                        <div class="feed-element">--}}
                        {{--                            <div>--}}
                        {{--                                <small class="pull-right">2m ago</small>--}}
                        {{--                                <strong>Jogn Angel</strong>--}}
                        {{--                                <div>There are many variations of passages of Lorem Ipsum available</div>--}}
                        {{--                                <small class="text-muted">Today 2:23 pm - 11.06.2014</small>--}}
                        {{--                            </div>--}}
                        {{--                        </div>--}}

                        {{--                        <div class="feed-element">--}}
                        {{--                            <div>--}}
                        {{--                                <small class="pull-right">5m ago</small>--}}
                        {{--                                <strong>Jesica Ocean</strong>--}}
                        {{--                                <div>Contrary to popular belief, Lorem Ipsum</div>--}}
                        {{--                                <small class="text-muted">Today 1:00 pm - 08.06.2014</small>--}}
                        {{--                            </div>--}}
                        {{--                        </div>--}}

                        {{--                        <div class="feed-element">--}}
                        {{--                            <div>--}}
                        {{--                                <small class="pull-right">5m ago</small>--}}
                        {{--                                <strong>Monica Jackson</strong>--}}
                        {{--                                <div>The generated Lorem Ipsum is therefore</div>--}}
                        {{--                                <small class="text-muted">Yesterday 8:48 pm - 10.06.2014</small>--}}
                        {{--                            </div>--}}
                        {{--                        </div>--}}


                        {{--                        <div class="feed-element">--}}
                        {{--                            <div>--}}
                        {{--                                <small class="pull-right">5m ago</small>--}}
                        {{--                                <strong>Anna Legend</strong>--}}
                        {{--                                <div>All the Lorem Ipsum generators on the Internet tend to repeat</div>--}}
                        {{--                                <small class="text-muted">Yesterday 8:48 pm - 10.06.2014</small>--}}
                        {{--                            </div>--}}
                        {{--                        </div>--}}
                        {{--                        <div class="feed-element">--}}
                        {{--                            <div>--}}
                        {{--                                <small class="pull-right">5m ago</small>--}}
                        {{--                                <strong>Damian Nowak</strong>--}}
                        {{--                                <div>The standard chunk of Lorem Ipsum used</div>--}}
                        {{--                                <small class="text-muted">Yesterday 8:48 pm - 10.06.2014</small>--}}
                        {{--                            </div>--}}
                        {{--                        </div>--}}
                        {{--                        <div class="feed-element">--}}
                        {{--                            <div>--}}
                        {{--                                <small class="pull-right">5m ago</small>--}}
                        {{--                                <strong>Gary Smith</strong>--}}
                        {{--                                <div>200 Latin words, combined with a handful</div>--}}
                        {{--                                <small class="text-muted">Yesterday 8:48 pm - 10.06.2014</small>--}}
                        {{--                            </div>--}}
                        {{--                        </div>--}}

                        {{--                    </div>--}}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>TOP tin tức xem nhiều nhất</h5>
                    <div class="ibox-tools">
                        {{--                        <a class="collapse-link">--}}
                        {{--                            <i class="fa fa-chevron-up"></i>--}}
                        {{--                        </a>--}}
                        {{--                      <a class="close-link">--}}
                        {{--                          <i class="fa fa-times"></i>--}}
                        {{--                      </a>--}}
                    </div>
                </div>
                {{--              <div class="ibox-content ibox-heading">--}}
                {{--                  <h3><i class="fa fa-envelope-o"></i> New messages</h3>--}}
                {{--                  <small><i class="fa fa-tim"></i> You have 22 new messages and 16 waiting in draft folder.</small>--}}
                {{--              </div>--}}
                <div class="ibox-content">
                    <div class="feed-activity-list">
                        @foreach($top_view_posts as $post)
                            <div class="feed-element">
                                <div>
                                    <small class="pull-right text-navy">{{$post->created_at->format('M d, Y')}}</small>
                                    <strong>{{$post->user->name}}</strong>
                                    <br>
                                    <a href="{{route('post.edit', ['id' => $post->id])}}" class="text-[#99c3ff] font-semibold text-[14px]">{{$post->languages->first()->pivot->name}}</a>
                                </div>
                            </div>
                        @endforeach


                        {{--                        <div class="feed-element">--}}
                        {{--                            <div>--}}
                        {{--                                <small class="pull-right">2m ago</small>--}}
                        {{--                                <strong>Jogn Angel</strong>--}}
                        {{--                                <div>There are many variations of passages of Lorem Ipsum available</div>--}}
                        {{--                                <small class="text-muted">Today 2:23 pm - 11.06.2014</small>--}}
                        {{--                            </div>--}}
                        {{--                        </div>--}}

                        {{--                        <div class="feed-element">--}}
                        {{--                            <div>--}}
                        {{--                                <small class="pull-right">5m ago</small>--}}
                        {{--                                <strong>Jesica Ocean</strong>--}}
                        {{--                                <div>Contrary to popular belief, Lorem Ipsum</div>--}}
                        {{--                                <small class="text-muted">Today 1:00 pm - 08.06.2014</small>--}}
                        {{--                            </div>--}}
                        {{--                        </div>--}}

                        {{--                        <div class="feed-element">--}}
                        {{--                            <div>--}}
                        {{--                                <small class="pull-right">5m ago</small>--}}
                        {{--                                <strong>Monica Jackson</strong>--}}
                        {{--                                <div>The generated Lorem Ipsum is therefore</div>--}}
                        {{--                                <small class="text-muted">Yesterday 8:48 pm - 10.06.2014</small>--}}
                        {{--                            </div>--}}
                        {{--                        </div>--}}


                        {{--                        <div class="feed-element">--}}
                        {{--                            <div>--}}
                        {{--                                <small class="pull-right">5m ago</small>--}}
                        {{--                                <strong>Anna Legend</strong>--}}
                        {{--                                <div>All the Lorem Ipsum generators on the Internet tend to repeat</div>--}}
                        {{--                                <small class="text-muted">Yesterday 8:48 pm - 10.06.2014</small>--}}
                        {{--                            </div>--}}
                        {{--                        </div>--}}
                        {{--                        <div class="feed-element">--}}
                        {{--                            <div>--}}
                        {{--                                <small class="pull-right">5m ago</small>--}}
                        {{--                                <strong>Damian Nowak</strong>--}}
                        {{--                                <div>The standard chunk of Lorem Ipsum used</div>--}}
                        {{--                                <small class="text-muted">Yesterday 8:48 pm - 10.06.2014</small>--}}
                        {{--                            </div>--}}
                        {{--                        </div>--}}
                        {{--                        <div class="feed-element">--}}
                        {{--                            <div>--}}
                        {{--                                <small class="pull-right">5m ago</small>--}}
                        {{--                                <strong>Gary Smith</strong>--}}
                        {{--                                <div>200 Latin words, combined with a handful</div>--}}
                        {{--                                <small class="text-muted">Yesterday 8:48 pm - 10.06.2014</small>--}}
                        {{--                            </div>--}}
                        {{--                        </div>--}}

                        {{--                    </div>--}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
