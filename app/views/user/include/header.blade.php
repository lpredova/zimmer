<title>Hello {{$user->name}} | Explore the world.</title>
        {{ HTML::style('css/bootstrap.min.css') }}
        {{ HTML::style('font-awesome-4.1.0/css/font-awesome.min.css') }}
        {{ HTML::style('http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700,300italic,400italic,700italic') }}
        <!-- Ionicons -->
        {{ HTML::style("//code.ionicframework.com/ionicons/1.5.2/css/ionicons.min.css") }}
        <!-- Theme style -->
        {{ HTML::style("admin/css/AdminLTE.css") }}

<body class="skin-blue">
        <header class="header">
            <a href="owner" class="logo">
            Zimmer Frei
            </a>

            <nav class="navbar navbar-static-top" role="navigation">
                <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <div class="navbar-right">
                    <ul class="nav navbar-nav">
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="glyphicon glyphicon-user"></i>
                                <span>{{$user->name}} <i class="caret"></i></span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header bg-light-blue">
                                    <img src="{{$user->avatar}}" class="img-circle" alt="User Image" />
                                    <p>
                                        {{$user->name}}{{$user->surname}}
                                        <small>Member since Nov. {{$user->created_at}}</small>
                                    </p>
                                </li>
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="owner/profile" class="btn btn-default btn-flat">Profile</a>
                                    </div>
                                    <div class="pull-right">
                                        <a href="logout" class="btn btn-default btn-flat">Sign out</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="left-side sidebar-offcanvas">
                <section class="sidebar">
                    <div class="user-panel">
                        <div class="pull-left image">
                            <img src="{{$user->avatar}}" class="img-circle" alt="User Image" />
                        </div>
                        <div class="pull-left info">
                            <p>Hello, {{$user->username}}</p>
                            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                        </div>
                    </div>

                    <ul class="sidebar-menu">
                        <li class="active">
                            <a href="user">
                                <i class="fa fa-home"></i> <span>Main</span>
                            </a>
                        </li>
                        <li>
                          <a href="#">
                              <i class="fa fa-calendar"></i>
                                 <span>Bookings</span>
                          </a>
                        </li>

                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-heart"></i>
                                <span>Apartments</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="#"><i class="fa fa-angle-double-right"></i>Index</a></li>
                            </ul>
                        </li>

                        <li>
                           <a href="#">
                                 <i class="fa fa-star"></i>
                               <span>Favorites</span>
                           </a>
                        </li>
                    </ul>

                </section>
            </aside>