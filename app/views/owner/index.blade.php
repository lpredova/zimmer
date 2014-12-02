@include('owner.include.header')
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
                    @yield('ownerContent')
                </section>
            </aside>
        </div>
@include('owner.include.footer')
