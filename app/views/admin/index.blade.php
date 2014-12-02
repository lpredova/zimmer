@include('admin.includes.header')


<!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        <small>Control panel</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i></a></li>
                        <li class="active">Dashboard</li>
                    </ol>
                </section>

                <section class="content">
                    @yield('adminContent')

                </section>
            </aside>
        </div>
@include('admin.includes.footer')
