@include('user.include.header')

  <aside class="right-side">
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
                    @yield('userContent')
                </section>
            </aside>
        </div>
@include('user.include.footer')