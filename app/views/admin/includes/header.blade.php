<title>Hello {{Auth::user()->name}} | Explore the world.</title>
{{ HTML::style('/assets/css/bootstrap.min.css') }}
{{ HTML::style('/assets/font-awesome-4.1.0/css/font-awesome.min.css') }}
{{ HTML::style('http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700,300italic,400italic,700italic') }}
<!-- Ionicons -->
{{ HTML::style("//code.ionicframework.com/ionicons/1.5.2/css/ionicons.min.css") }}
<!-- Theme style -->
{{ HTML::style("/assets/admin/css/AdminLTE.css") }}
{{ HTML::style('assets/css/style.css') }}


<!--Datatables style-->
{{ HTML::style("//cdn.datatables.net/plug-ins/a5734b29083/integration/bootstrap/3/dataTables.bootstrap.css") }}
{{ HTML::style("//cdnjs.cloudflare.com/ajax/libs/select2/3.5.0/select2.min.css") }}
{{ HTML::style("//cdnjs.cloudflare.com/ajax/libs/select2/3.5.0/select2-bootstrap.min.css") }}


<body class="skin-blue">
<header class="header">
    <a href="/owner" class="logo">
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
                        <span>{{Auth::user()->name}} <i class="caret"></i></span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header bg-light-blue">
                            <img src="{{Auth::user()->avatar}}" class="img-circle" alt="User Image"/>

                            <p>
                                {{Auth::user()->name}}{{Auth::user()->surname}}
                                <small>Member since Nov. {{Auth::user()->created_at}}</small>
                            </p>
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="profile" class="btn btn-default btn-flat">Profile</a>
                            </div>
                            <div class="pull-right">
                                <a href="/logout" class="btn btn-default btn-flat">Sign out</a>
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
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            <!-- Sidebar user panel -->
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="{{Auth::user()->avatar}}" class="img-circle" alt="User Image"/>
                </div>
                <div class="pull-left info">
                    <p>Hello, {{Auth::user()->username}}</p>
                    <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                </div>
            </div>

            <ul class="sidebar-menu">
                <li class="active">
                    <a href="/admin/main">
                        <i class="fa fa-dashboard"></i> <span>Main</span>
                    </a>
                </li>

                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-user"></i>
                        <span>Users</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="/admin/users"><i class="fa fa-angle-double-right"></i>Index</a></li>
                        <li><a href="/admin/users/new"><i class="fa fa-angle-double-right"></i>Add</a></li>
                        <li><a href="/admin/roles"><i class="fa fa-angle-double-right"></i>User Roles</a></li>
                    </ul>
                </li>

                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-wechat"></i>
                        <span>Social</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="/admin/favorites"><i class="fa fa-star"></i>Favorites</a></li>
                        <li><a href="/admin/ratings"><i class="fa fa-comment"></i>Rating</a></li>
                    </ul>
                </li>

                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-home"></i>
                        <span>Apartments</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="/admin/apartments"><i class="fa fa-angle-double-right"></i>Index</a></li>
                        <li><a href="/admin/apartments/new"><i class="fa fa-angle-double-right"></i>Add</a></li>
                        <li><a href="/admin/pictures"><i class="fa fa-angle-double-right"></i>Pictures</a></li>
                        <li><a href="/admin/apartment_types"><i class="fa fa-angle-double-right"></i>Apartment Types</a>
                        </li>
                    </ul>
                </li>

                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-suitcase"></i> <span>Rooms</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="/admin/rooms"><i class="fa fa-angle-double-right"></i>Index</a></li>
                        <li><a href="/admin/rooms/new"><i class="fa fa-angle-double-right"></i>Add</a></li>
                    </ul>
                </li>

                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-gift"></i> <span>Fittings</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="/admin/fitting"><i class="fa fa-angle-double-right"></i>Index</a></li>
                        <li><a href="/admin/fitting/new"><i class="fa fa-angle-double-right"></i>Add</a></li>
                    </ul>
                </li>

                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-envelope"></i> <span>Push notifications</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="/admin/push"><i class="fa fa-angle-double-right"></i>Push notifications</a></li>
                        <li><a href="/admin/push"><i class="fa fa-angle-double-right"></i>Promote apartment</a></li>
                    </ul>
                </li>
                <li>
                    <a href="/admin/countries">
                        <i class="fa fa-flag"></i> <span>Countries</span>
                    </a>
                </li>

                <li>
                    <a href="/admin/city">
                        <i class="fa fa-flag"></i> <span>Cities</span>
                    </a>
                </li>

                <li>
                    <a href=/admin/stats>
                        <i class="fa fa-bar-chart-o"></i>
                        <span>Stats</span>
                    </a>
                </li>

            </ul>
        </section>
        <!-- /.sidebar -->
    </aside>