<!DOCTYPE html>
<html>

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $title or "Propeller" }}</title>       
    <meta name="csrf-token" content="{!! csrf_token() !!}">
    {!! HTML::style('assets/css/bootstrap.min.css')!!}
    {!! HTML::style('assets/font-awesome/css/font-awesome.min.css')!!}

    <!-- Toastr style -->
    {!! HTML::style('assets/css/plugins/toastr/toastr.min.css')!!}
    
    <!-- Gritter -->
    {!! HTML::style('assets/js/plugins/gritter/jquery.gritter.css')!!}
    
    {!! HTML::style('assets/css/animate.css')!!}
    {!! HTML::style('assets/css/compiled/style.css')!!}

    @yield('head.css')

</head>

<body>
  <div id="wrapper">
    <!-- NAV BAR STARTS -->
    <nav class="navbar-default navbar-static-side" role="navigation">
      <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
          <li class="nav-header">
            <div class="dropdown profile-element">
              <span>
                <img alt="image" class="img-circle" src="images/demo/profile_small.jpg" />
              </span>
              <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                <span class="clear">
                  <span class="block m-t-xs">
                    <strong class="font-bold">Allison Reid</strong>
                  </span>
                  <span class="text-muted text-xs block">Events Director <b class="caret"></b></span>
                </span>
              </a>
              <ul class="dropdown-menu animated fadeInRight m-t-xs">
                <li><a href="{!! URL::route('user.getProfile',Auth::user()->id) !!}">Profile</a></li>
                <li><a href="#">Contacts</a></li>
                <li><a href="#">Mailbox</a></li>
                <li class="divider"></li>
                <li><a href="{!! URL::to('/logout') !!}">Logout</a></li>
              </ul>
            </div>
            <div class="logo-element">
              IN+
            </div>
          </li>
          <li class="active">
            <a href="/"><i class="fa fa-home"></i> <span class="nav-label">HOME</span></a>
          </li>
          <li>
            <a href="#"><i class="fa fa-th-large"></i> <span class="nav-label">Events</span> <span class="fa arrow"></span></a>
            <ul class="nav nav-second-level collapse">
              <li class="active"><a href="#">2016 School Auction</a></li>
              <li><a href="#">2016 Grandparents Day</a></li>
              <li><a href="#">2016 Car Wash</a></li>
              <li><a href="#">2016 Mercado</a></li>
            </ul>
          </li>
          <li>
            <a href="#"><i class="fa fa-users"></i> <span class="nav-label">People</span><span class="fa arrow"></span></a>
            <ul class="nav nav-second-level collapse">
              <li><a href="{!! URL::route('user.create') !!}">Create user</a></li>
              <li><a href="{!! URL::route('user.getUserSameTenant')!!}">List user</a></li>
              <li><a href="#">Create person</a></li>
              <li><a href="#">List People</a></li>
            </ul>
          </li>
          
          <li>
            <a href="#"><i class="fa fa-pie-chart"></i> <span class="nav-label">Reports</span> </a>
          </li>
          <li>
            <a href="#"><i class="fa fa-envelope"></i> <span class="nav-label">Messages </span><span class="label label-warning pull-right">16/24</span></a>
            <ul class="nav nav-second-level collapse">
              <li><a href="#">Inbox</a></li>
              <li><a href="#">Email view</a></li>
              <li><a href="#">Compose email</a></li>
              <li><a href="#">Email templates</a></li>
            </ul>
          </li>
          <li>
            <a href="#"><i class="fa fa-thumbs-up"></i> <span class="nav-label">Templates</span><span class="fa arrow"></span></a>
            <ul class="nav nav-second-level collapse">
              <li><a href="#">Purchased Templates</a></li>
              <li><a href="#">Available Templates</a></li>
              <li><a href="#">Free Templates</a></li>
            </ul>
          </li>        
          <li>
            <a href="#"><i class="fa fa-picture-o"></i> <span class="nav-label">Gallery</span><span class="fa arrow"></span></a>
            <ul class="nav nav-second-level collapse">
              <li><a href="#">Image Gallery</a></li>
              <li><a href="#">Document Gallery</a></li>

            </ul>
          </li>
          <li>
            <a href="#"><i class="fa fa-briefcase"></i> <span class="nav-label">Documents</span> </a>
          </li>
          <li>
            <a href="#"><i class="fa fa-gears"></i> <span class="nav-label">Tools</span> </a>
          </li>
        </ul>

      </div>
    </nav>
    <!-- NAV BAR ENDS -->
    <!-- content -->    
    <div id="page-wrapper" class="gray-bg dashbard-1">
      <!-- HEADER NAV -->
      <div class="row border-bottom">
        <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
          <div class="navbar-header">
            <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
            <form role="search" class="navbar-form-custom" action="#">
              <div class="form-group">
                <input type="text" placeholder="Search for something..." class="form-control" name="top-search" id="top-search">
              </div>
            </form>
          </div>
          <ul class="nav navbar-top-links navbar-right">
            <li>
              <!--<span class="m-r-sm text-muted welcome-message">Welcome to Harbor School Events.</span>-->
               @widget('SwitchTenant')
            </li>
            <li class="dropdown">
              <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                <i class="fa fa-envelope"></i>
                <span class="label label-warning">16</span>
              </a>
              <ul class="dropdown-menu dropdown-messages">
                <li>
                  <div class="dropdown-messages-box">
                    <a href="#" class="pull-left">
                      <img alt="image" class="img-circle" src="images/demo/a7.jpg">
                    </a>
                    <div class="media-body">
                      <small class="pull-right">46h ago</small>
                      <strong>Mike Loreipsum</strong> started following
                      <strong>Monica Smith</strong>.
                      <br>
                      <small class="text-muted">3 days ago at 7:58 pm - 10.06.2014</small>
                    </div>
                  </div>
                </li>
                <li class="divider"></li>
                <li>
                  <div class="dropdown-messages-box">
                    <a href="{!! URL::route('user.getProfile',Auth::user()->id) !!}" class="pull-left">
                      <img alt="image" class="img-circle" src="images/demo/a4.jpg">
                    </a>
                    <div class="media-body ">
                      <small class="pull-right text-navy">5h ago</small>
                      <strong>Chris Johnatan Overtunk</strong> started following
                      <strong>Monica Smith</strong>.
                      <br>
                      <small class="text-muted">Yesterday 1:21 pm - 11.06.2014</small>
                    </div>
                  </div>
                </li>
                <li class="divider"></li>
                <li>
                  <div class="dropdown-messages-box">
                    <a href="{!! URL::route('user.getProfile',Auth::user()->id) !!}" class="pull-left">
                      <img alt="image" class="img-circle" src="images/demo/profile.jpg">
                    </a>
                    <div class="media-body ">
                      <small class="pull-right">23h ago</small>
                      <strong>Monica Smith</strong> love
                      <strong>Kim Smith</strong>.
                      <br>
                      <small class="text-muted">2 days ago at 2:30 am - 11.06.2014</small>
                    </div>
                  </div>
                </li>
                <li class="divider"></li>
                <li>
                  <div class="text-center link-block">
                    <a href="#">
                      <i class="fa fa-envelope"></i>
                      <strong>Read All Messages</strong>
                    </a>
                  </div>
                </li>
              </ul>
            </li>
            <li class="dropdown">
              <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                <i class="fa fa-bell"></i>
                <span class="label label-primary">8</span>
              </a>
              <ul class="dropdown-menu dropdown-alerts">
                <li>
                  <a href="#">
                    <div>
                      <i class="fa fa-envelope fa-fw"></i> You have 16 messages
                      <span class="pull-right text-muted small">4 minutes ago</span>
                    </div>
                  </a>
                </li>
                <li class="divider"></li>
                <li>
                  <a href="#">
                    <div>
                      <i class="fa fa-twitter fa-fw"></i> 3 New Followers
                      <span class="pull-right text-muted small">12 minutes ago</span>
                    </div>
                  </a>
                </li>
                <li class="divider"></li>
                <li>
                  <a href="#">
                    <div>
                      <i class="fa fa-upload fa-fw"></i> Server Rebooted
                      <span class="pull-right text-muted small">4 minutes ago</span>
                    </div>
                  </a>
                </li>
                <li class="divider"></li>
                <li>
                  <div class="text-center link-block">
                    <a href="#">
                      <strong>See All Alerts</strong>
                      <i class="fa fa-angle-right"></i>
                    </a>
                  </div>
                </li>
              </ul>
            </li>


            <li>
              <a href="{!! URL::to('/logout') !!}">
                <i class="fa fa-sign-out"></i> Log out
              </a>
            </li>
            <li>
              <a class="right-sidebar-toggle">
                <i class="fa fa-tasks"></i>
              </a>
            </li>
          </ul>

        </nav>
      </div>
      <!-- end header nav -->
      @yield('content')
    </div>
<!-- content end -->
    <div class="small-chat-box fadeInRight animated">

      <div class="heading" draggable="true">
        <small class="chat-date pull-right">
          02.19.2015
        </small>
        Small chat
      </div>

      <div class="content">

        <div class="left">
          <div class="author-name">
            Monica Jackson
            <small class="chat-date">
              10:02 am
            </small>
          </div>
          <div class="chat-message active">
            Lorem Ipsum is simply dummy text input.
          </div>

        </div>
        <div class="right">
          <div class="author-name">
            Mick Smith
            <small class="chat-date">
              11:24 am
            </small>
          </div>
          <div class="chat-message">
            Lorem Ipsum is simpl.
          </div>
        </div>
        <div class="left">
          <div class="author-name">
            Alice Novak
            <small class="chat-date">
              08:45 pm
            </small>
          </div>
          <div class="chat-message active">
            Check this stock char.
          </div>
        </div>
        <div class="right">
          <div class="author-name">
            Anna Lamson
            <small class="chat-date">
              11:24 am
            </small>
          </div>
          <div class="chat-message">
            The standard chunk of Lorem Ipsum
          </div>
        </div>
        <div class="left">
          <div class="author-name">
            Mick Lane
            <small class="chat-date">
              08:45 pm
            </small>
          </div>
          <div class="chat-message active">
            I belive that. Lorem Ipsum is simply dummy text.
          </div>
        </div>


      </div>
      <div class="form-chat">
        <div class="input-group input-group-sm">
          <input type="text" class="form-control">
          <span class="input-group-btn">
            <button class="btn btn-primary" type="button">Send
            </button>
          </span>
        </div>
      </div>

    </div>
    <div id="small-chat">

      <span class="badge badge-warning pull-right">5</span>
      <a class="open-small-chat">
        <i class="fa fa-comments"></i>

      </a>
    </div>
    <div id="right-sidebar">
      <div class="sidebar-container">

        <ul class="nav nav-tabs navs-3">

          <li class="active"><a data-toggle="tab" href="#tab-1">
                        Notes
                    </a></li>
          <li><a data-toggle="tab" href="#tab-2">
                        Events
                    </a></li>
          <li class="">
            <a data-toggle="tab" href="#tab-3">
              <i class="fa fa-gear"></i>
            </a>
          </li>
        </ul>

        
        <div class="tab-content">

    <div id="tab-1" class="tab-pane active">

            <div class="sidebar-title">
              <h3> <i class="fa fa-comments-o"></i> Latest Notes</h3>
              <small><i class="fa fa-tim"></i> You have 10 new message.</small>
            </div>

            <div>

              <div class="sidebar-message">
                <a href="#">
                  <div class="pull-left text-center">
                    <img alt="image" class="img-circle message-avatar" src="images/demo/a1.jpg">

                    <div class="m-t-xs">
                      <i class="fa fa-star text-warning"></i>
                      <i class="fa fa-star text-warning"></i>
                    </div>
                  </div>
                  <div class="media-body">

                    There are many variations of passages of Lorem Ipsum available.
                    <br>
                    <small class="text-muted">Today 4:21 pm</small>
                  </div>
                </a>
              </div>
              <div class="sidebar-message">
                <a href="#">
                  <div class="pull-left text-center">
                    <img alt="image" class="img-circle message-avatar" src="images/demo/a2.jpg">
                  </div>
                  <div class="media-body">
                    The point of using Lorem Ipsum is that it has a more-or-less normal.
                    <br>
                    <small class="text-muted">Yesterday 2:45 pm</small>
                  </div>
                </a>
              </div>
              <div class="sidebar-message">
                <a href="#">
                  <div class="pull-left text-center">
                    <img alt="image" class="img-circle message-avatar" src="images/demo/a3.jpg">

                    <div class="m-t-xs">
                      <i class="fa fa-star text-warning"></i>
                      <i class="fa fa-star text-warning"></i>
                      <i class="fa fa-star text-warning"></i>
                    </div>
                  </div>
                  <div class="media-body">
                    Mevolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).
                    <br>
                    <small class="text-muted">Yesterday 1:10 pm</small>
                  </div>
                </a>
              </div>
              <div class="sidebar-message">
                <a href="#">
                  <div class="pull-left text-center">
                    <img alt="image" class="img-circle message-avatar" src="images/demo/a4.jpg">
                  </div>

                  <div class="media-body">
                    Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the
                    <br>
                    <small class="text-muted">Monday 8:37 pm</small>
                  </div>
                </a>
              </div>
              <div class="sidebar-message">
                <a href="#">
                  <div class="pull-left text-center">
                    <img alt="image" class="img-circle message-avatar" src="images/demo/a8.jpg">
                  </div>
                  <div class="media-body">

                    All the Lorem Ipsum generators on the Internet tend to repeat.
                    <br>
                    <small class="text-muted">Today 4:21 pm</small>
                  </div>
                </a>
              </div>
              <div class="sidebar-message">
                <a href="#">
                  <div class="pull-left text-center">
                    <img alt="image" class="img-circle message-avatar" src="images/demo/a7.jpg">
                  </div>
                  <div class="media-body">
                    Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.
                    <br>
                    <small class="text-muted">Yesterday 2:45 pm</small>
                  </div>
                </a>
              </div>
              <div class="sidebar-message">
                <a href="#">
                  <div class="pull-left text-center">
                    <img alt="image" class="img-circle message-avatar" src="images/demo/a3.jpg">

                    <div class="m-t-xs">
                      <i class="fa fa-star text-warning"></i>
                      <i class="fa fa-star text-warning"></i>
                      <i class="fa fa-star text-warning"></i>
                    </div>
                  </div>
                  <div class="media-body">
                    The standard chunk of Lorem Ipsum used since the 1500s is reproduced below.
                    <br>
                    <small class="text-muted">Yesterday 1:10 pm</small>
                  </div>
                </a>
              </div>
              <div class="sidebar-message">
                <a href="#">
                  <div class="pull-left text-center">
                    <img alt="image" class="img-circle message-avatar" src="images/demo/a4.jpg">
                  </div>
                  <div class="media-body">
                    Uncover many web sites still in their infancy. Various versions have.
                    <br>
                    <small class="text-muted">Monday 8:37 pm</small>
                  </div>
                </a>
              </div>
            </div>

          </div>

          <div id="tab-2" class="tab-pane">

            <div class="sidebar-title">
              <h3> <i class="fa fa-cube"></i> Latest Events</h3>
              <small><i class="fa fa-tim"></i> You have 4 Events. 2 not completed.</small>
            </div>

            <ul class="sidebar-list">
              <li>
                <a href="#">
                  <div class="small pull-right m-t-xs">9 hours ago</div>
                  <h4>Business valuation</h4>
                  It is a long established fact that a reader will be distracted.

                  <div class="small">Completion with: 22%</div>
                  <div class="progress progress-mini">
                    <div style="width: 22%;" class="progress-bar progress-bar-warning"></div>
                  </div>
                  <div class="small text-muted m-t-xs">Project end: 4:00 pm - 12.06.2014</div>
                </a>
              </li>
              <li>
                <a href="#">
                  <div class="small pull-right m-t-xs">9 hours ago</div>
                  <h4>Contract with Company </h4>
                  Many desktop publishing packages and web page editors.

                  <div class="small">Completion with: 48%</div>
                  <div class="progress progress-mini">
                    <div style="width: 48%;" class="progress-bar"></div>
                  </div>
                </a>
              </li>
              <li>
                <a href="#">
                  <div class="small pull-right m-t-xs">9 hours ago</div>
                  <h4>Meeting</h4>
                  By the readable content of a page when looking at its layout.

                  <div class="small">Completion with: 14%</div>
                  <div class="progress progress-mini">
                    <div style="width: 14%;" class="progress-bar progress-bar-info"></div>
                  </div>
                </a>
              </li>
              <li>
                <a href="#">
                  <span class="label label-primary pull-right">NEW</span>
                  <h4>The generated</h4>
                  <!--<div class="small pull-right m-t-xs">9 hours ago</div>-->
                  There are many variations of passages of Lorem Ipsum available.
                  <div class="small">Completion with: 22%</div>
                  <div class="small text-muted m-t-xs">Project end: 4:00 pm - 12.06.2014</div>
                </a>
              </li>
              <li>
                <a href="#">
                  <div class="small pull-right m-t-xs">9 hours ago</div>
                  <h4>Business valuation</h4>
                  It is a long established fact that a reader will be distracted.

                  <div class="small">Completion with: 22%</div>
                  <div class="progress progress-mini">
                    <div style="width: 22%;" class="progress-bar progress-bar-warning"></div>
                  </div>
                  <div class="small text-muted m-t-xs">Project end: 4:00 pm - 12.06.2014</div>
                </a>
              </li>
              <li>
                <a href="#">
                  <div class="small pull-right m-t-xs">9 hours ago</div>
                  <h4>Contract with Company </h4>
                  Many desktop publishing packages and web page editors.

                  <div class="small">Completion with: 48%</div>
                  <div class="progress progress-mini">
                    <div style="width: 48%;" class="progress-bar"></div>
                  </div>
                </a>
              </li>
              <li>
                <a href="#">
                  <div class="small pull-right m-t-xs">9 hours ago</div>
                  <h4>Meeting</h4>
                  By the readable content of a page when looking at its layout.

                  <div class="small">Completion with: 14%</div>
                  <div class="progress progress-mini">
                    <div style="width: 14%;" class="progress-bar progress-bar-info"></div>
                  </div>
                </a>
              </li>
              <li>
                <a href="#">
                  <span class="label label-primary pull-right">NEW</span>
                  <h4>The generated</h4>
                  <!--<div class="small pull-right m-t-xs">9 hours ago</div>-->
                  There are many variations of passages of Lorem Ipsum available.
                  <div class="small">Completion with: 22%</div>
                  <div class="small text-muted m-t-xs">Project end: 4:00 pm - 12.06.2014</div>
                </a>
              </li>

            </ul>

          </div>

          <div id="tab-3" class="tab-pane">

            <div class="sidebar-title">
              <h3><i class="fa fa-gears"></i> Settings</h3>
              <small><i class="fa fa-tim"></i> You have 14 projects. 10 not completed.</small>
            </div>

            <div class="setings-item">
              <span>
                Show notifications
              </span>
              <div class="switch">
                <div class="onoffswitch">
                  <input type="checkbox" name="collapsemenu" class="onoffswitch-checkbox" id="example">
                  <label class="onoffswitch-label" for="example">
                    <span class="onoffswitch-inner"></span>
                    <span class="onoffswitch-switch"></span>
                  </label>
                </div>
              </div>
            </div>
            <div class="setings-item">
              <span>
                Disable Chat
              </span>
              <div class="switch">
                <div class="onoffswitch">
                  <input type="checkbox" name="collapsemenu" checked class="onoffswitch-checkbox" id="example2">
                  <label class="onoffswitch-label" for="example2">
                    <span class="onoffswitch-inner"></span>
                    <span class="onoffswitch-switch"></span>
                  </label>
                </div>
              </div>
            </div>
            <div class="setings-item">
              <span>
                Enable history
              </span>
              <div class="switch">
                <div class="onoffswitch">
                  <input type="checkbox" name="collapsemenu" class="onoffswitch-checkbox" id="example3">
                  <label class="onoffswitch-label" for="example3">
                    <span class="onoffswitch-inner"></span>
                    <span class="onoffswitch-switch"></span>
                  </label>
                </div>
              </div>
            </div>
            <div class="setings-item">
              <span>
                Show charts
              </span>
              <div class="switch">
                <div class="onoffswitch">
                  <input type="checkbox" name="collapsemenu" class="onoffswitch-checkbox" id="example4">
                  <label class="onoffswitch-label" for="example4">
                    <span class="onoffswitch-inner"></span>
                    <span class="onoffswitch-switch"></span>
                  </label>
                </div>
              </div>
            </div>
            <div class="setings-item">
              <span>
                Offline users
              </span>
              <div class="switch">
                <div class="onoffswitch">
                  <input type="checkbox" checked name="collapsemenu" class="onoffswitch-checkbox" id="example5">
                  <label class="onoffswitch-label" for="example5">
                    <span class="onoffswitch-inner"></span>
                    <span class="onoffswitch-switch"></span>
                  </label>
                </div>
              </div>
            </div>
            <div class="setings-item">
              <span>
                Global search
              </span>
              <div class="switch">
                <div class="onoffswitch">
                  <input type="checkbox" checked name="collapsemenu" class="onoffswitch-checkbox" id="example6">
                  <label class="onoffswitch-label" for="example6">
                    <span class="onoffswitch-inner"></span>
                    <span class="onoffswitch-switch"></span>
                  </label>
                </div>
              </div>
            </div>
            <div class="setings-item">
              <span>
                Update everyday
              </span>
              <div class="switch">
                <div class="onoffswitch">
                  <input type="checkbox" name="collapsemenu" class="onoffswitch-checkbox" id="example7">
                  <label class="onoffswitch-label" for="example7">
                    <span class="onoffswitch-inner"></span>
                    <span class="onoffswitch-switch"></span>
                  </label>
                </div>
              </div>
            </div>

            <div class="sidebar-content">
              <h4>Settings</h4>
              <div class="small">
                I belive that. Lorem Ipsum is simply dummy text of the printing and typesetting industry. And typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s. Over the years, sometimes by accident, sometimes on purpose
                (injected humour and the like).
              </div>
            </div>

        </div>
    </div>
    </div>
  </div>
  </div>
  <!-- Mainly scripts -->
    {!! HTML::script('assets/js/jquery.min.js')!!}        
    {!! HTML::script('assets/js/bootstrap.min.js')!!}        
    {!! HTML::script('assets/js/template.js')!!}   
    {!! HTML::script('assets/js/plugins/metisMenu/jquery.metisMenu.js')!!}   
    {!! HTML::script('assets/js/plugins/slimscroll/jquery.slimscroll.min.js')!!}   

  <!-- Flot -->
    {!! HTML::script('assets/js/plugins/flot/jquery.flot.js')!!}   
    {!! HTML::script('assets/js/plugins/flot/jquery.flot.tooltip.min.js')!!}   
    {!! HTML::script('assets/js/plugins/flot/jquery.flot.spline.js')!!}   
    {!! HTML::script('assets/js/plugins/flot/jquery.flot.resize.js')!!}   
    {!! HTML::script('assets/js/plugins/flot/jquery.flot.pie.js')!!}   


  <!-- Peity -->
    {!! HTML::script('assets/js/plugins/peity/jquery.peity.min.js')!!}   
    {!! HTML::script('assets/js/demo/peity-demo.js')!!}   


  <!-- Custom and plugin javascript -->
    {!! HTML::script('assets/js/inspinia.js')!!}   
    {!! HTML::script('assets/js/plugins/pace/pace.min.js')!!} 
  <!-- jQuery UI -->
    {!! HTML::script('assets/js/plugins/jquery-ui/jquery-ui.min.js')!!} 

  <!-- GITTER -->
    {!! HTML::script('assets/js/plugins/gritter/jquery.gritter.min.js')!!} 

  <!-- Sparkline -->
    {!! HTML::script('assets/js/plugins/sparkline/jquery.sparkline.min.js')!!} 

  <!-- Sparkline demo data  -->
    {!! HTML::script('assets/js/demo/sparkline-demo.js')!!} 

  <!-- ChartJS-->
    {!! HTML::script('assets/js/plugins/chartJs/Chart.min.js')!!} 

  <!-- Toastr -->
    {!! HTML::script('assets/js/plugins/toastr/toastr.min.js')!!} 


  <script>
    $(document).ready(function() {
      setTimeout(function() {
        toastr.options = {
          closeButton: true,
          progressBar: true,
          showMethod: 'slideDown',
          timeOut: 4000
        };
        toastr.success('Powered by Propeller Seeds', 'Welcome to Harbor School Events');

      }, 1300);


      var data1 = [
        [0, 4],
        [1, 8],
        [2, 5],
        [3, 10],
        [4, 4],
        [5, 16],
        [6, 5],
        [7, 11],
        [8, 6],
        [9, 11],
        [10, 30],
        [11, 10],
        [12, 13],
        [13, 4],
        [14, 3],
        [15, 3],
        [16, 6]
      ];
      var data2 = [
        [0, 1],
        [1, 0],
        [2, 2],
        [3, 0],
        [4, 1],
        [5, 3],
        [6, 1],
        [7, 5],
        [8, 2],
        [9, 3],
        [10, 2],
        [11, 1],
        [12, 0],
        [13, 2],
        [14, 8],
        [15, 0],
        [16, 0]
      ];
      $("#flot-dashboard-chart").length && $.plot($("#flot-dashboard-chart"), [
        data1, data2
      ], {
        series: {
          lines: {
            show: false,
            fill: true
          },
          splines: {
            show: true,
            tension: 0.4,
            lineWidth: 1,
            fill: 0.4
          },
          points: {
            radius: 0,
            show: true
          },
          shadowSize: 2
        },
        grid: {
          hoverable: true,
          clickable: true,
          tickColor: "#d5d5d5",
          borderWidth: 1,
          color: '#d5d5d5'
        },
        colors: ["#1ab394", "#464f88"],
        xaxis: {},
        yaxis: {
          ticks: 4
        },
        tooltip: false
      });

      var doughnutData = [{
        value: 300,
        color: "#a3e1d4",
        highlight: "#1ab394",
        label: "App"
      }, {
        value: 50,
        color: "#dedede",
        highlight: "#1ab394",
        label: "Software"
      }, {
        value: 100,
        color: "#b5b8cf",
        highlight: "#1ab394",
        label: "Laptop"
      }];

      var doughnutOptions = {
        segmentShowStroke: true,
        segmentStrokeColor: "#fff",
        segmentStrokeWidth: 2,
        percentageInnerCutout: 45, // This is 0 for Pie charts
        animationSteps: 100,
        animationEasing: "easeOutBounce",
        animateRotate: true,
        animateScale: false
      };

      var ctx = document.getElementById("doughnutChart").getContext("2d");
      var DoughnutChart = new Chart(ctx).Doughnut(doughnutData, doughnutOptions);

      var polarData = [{
        value: 300,
        color: "#a3e1d4",
        highlight: "#1ab394",
        label: "App"
      }, {
        value: 140,
        color: "#dedede",
        highlight: "#1ab394",
        label: "Software"
      }, {
        value: 200,
        color: "#b5b8cf",
        highlight: "#1ab394",
        label: "Laptop"
      }];

      var polarOptions = {
        scaleShowLabelBackdrop: true,
        scaleBackdropColor: "rgba(255,255,255,0.75)",
        scaleBeginAtZero: true,
        scaleBackdropPaddingY: 1,
        scaleBackdropPaddingX: 1,
        scaleShowLine: true,
        segmentShowStroke: true,
        segmentStrokeColor: "#fff",
        segmentStrokeWidth: 2,
        animationSteps: 100,
        animationEasing: "easeOutBounce",
        animateRotate: true,
        animateScale: false
      };
      var ctx = document.getElementById("polarChart").getContext("2d");
      var Polarchart = new Chart(ctx).PolarArea(polarData, polarOptions);

    });
  </script>
  @yield('body.script')
</body>

</html>
