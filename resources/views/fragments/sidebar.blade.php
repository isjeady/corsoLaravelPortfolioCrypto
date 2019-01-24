 <!-- Left side column. contains the logo and sidebar -->
 <aside class="main-sidebar">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                <!-- Sidebar user panel -->
                <div class="user-panel">
                    <div class="pull-left image">
                    <img src="{{ URL::asset('adminlte/dist/img/user2-160x160.jpg') }}" class="img-circle" alt="User Image">
                    </div>
                    <div class="pull-left info">
                    <p>{{ Auth::user()->name }}</p>
                    <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                    </div>
                </div>
    
                <!-- sidebar menu: : style can be found in sidebar.less -->
                <ul class="sidebar-menu" data-widget="tree">
                    <li class="header">MAIN NAVIGATION</li>
                    
                    

                    <li class="{{ Request::is('dashboard') ? 'active' : '' }}">
                        <a href="{{ route('dashboardAlias') }}" >
                            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                        </a>
                    </li>
                    
                    <li class="{{ Request::is('cryptocurrencies') ? 'active' : '' }}">
                        <a href="{{ route('cryptocurrenciesRoute') }}" >
                            <i class="fa fa-dashboard"></i> <span>CryptoCurrencies</span>
                        </a>
                    </li>


                    <!--
                    <li>
                        <a href="pages/mailbox/mailbox.html">
                            <i class="fa fa-envelope"></i> <span>Mailbox</span>
                            <span class="pull-right-container">
                            <small class="label pull-right bg-yellow">12</small>
                            <small class="label pull-right bg-green">16</small>
                            <small class="label pull-right bg-red">5</small>
                            </span>
                        </a>
                    </li>
                    -->
                </ul>
                </section>
                <!-- /.sidebar -->
</aside>