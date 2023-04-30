<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ asset('assets/dist/img/user2-160x160.jpg') }}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{ Auth::user()->name }}</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <li class="{{ (request()->is('home') ? 'active' : '' ) }}">
                <a href="{{ url('home') }}"><i class="fa fa-dashboard"></i> Dashboard</a>
            </li>
            <li class="{{ (request()->is('customer*') ? 'active' : '' ) }}">
                <a href="{{ url('customer') }}"><i class="fa fa-users"></i> Customer</a>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>