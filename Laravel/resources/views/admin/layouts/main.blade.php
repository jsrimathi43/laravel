@extends('admin.layouts.primary')

@section('page_body')

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ url('admin/dashboard') }}">
        <div class="sidebar-brand-icon rotate-n-15">
          <i class="fas fa-user"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Admin</div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item">
        <a class="nav-link" href="{{ url('admin/dashboard') }} ">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        Interface
      </div>

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item  @if($main_manu == 'Users') active @endif ">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
          <i class="fas fa-fw fa-users"></i>
          <span>Users</span>
        </a>
        <div id="collapseOne" class="collapse  @if($main_manu == 'Users') show @endif" aria-labelledby="headingOne" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item @if($sub_manu == 'Groups') active @endif" href="{{ url('admin/groups') }}">Groups</a>
            <a class="collapse-item @if($sub_manu == 'Users') active @endif" href="{{ url('admin/users') }}">Users</a>
            <a class="collapse-item @if($sub_manu == 'Roles') active @endif" href="{{ url('admin/role') }}">Roles</a>
            <a class="collapse-item @if($sub_manu == 'DeliveryPartner') active @endif" href="{{ url('admin/deliveryPartners') }}">Delivery Partners</a>
            <a class="collapse-item @if($sub_manu == 'ContactUs') active @endif" href="{{ url('admin/contactus') }}">Customer Contactus</a>
          </div>
        </div>
      </li>

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item @if($main_manu == 'Products') active @endif">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fa fa-utensils"></i>
          <span>Products</span>
        </a>
        <div id="collapseTwo" class="collapse @if($main_manu == 'Products') show @endif" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item @if($sub_manu == 'Categories') active @endif" href="{{ url('admin/categories') }}">Categories</a>
            <a class="collapse-item @if($sub_manu == 'Products') active @endif" href="{{ url('admin/products') }}">Products</a>
            <a class="collapse-item @if($sub_manu == 'Stocks') active @endif" href="{{ route('admin.products.stocks') }}">Stocks</a>
          </div>
        </div>
      </li>

       <!-- Nav Item - Pages Collapse Menu -->
       <li class="nav-item @if($main_manu == 'Orders') active @endif">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
          <i class="fa fa-list-alt"></i>
          <span>Orders</span>
        </a>
        <div id="collapseThree" class="collapse @if($main_manu == 'Orders') show @endif" aria-labelledby="headingThree" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item @if($sub_manu == 'Orders') active @endif" href="{{ url('admin/orders') }}">Orders</a>
            <a class="collapse-item @if($sub_manu == 'Reviews') active @endif" href="{{ url('admin/reviews') }}">Reviews</a>
            <a class="collapse-item @if($sub_manu == 'OrderStatus') active @endif" href="{{ url('admin/orderstatus') }}">Order Status</a>
            <a class="collapse-item @if($sub_manu == 'BookingCalendar') active @endif" href="{{ url('admin/bookingcalendars') }}">Booking Details</a>
          </div>
        </div>
      </li>

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item @if($main_manu == 'Reports') active @endif">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseReport" aria-expanded="true" aria-controls="collapseReport">
          <i class="fas fa-fw fa-chart-area"></i>
          <span>Reports</span>
        </a>
        <div id="collapseReport" class="collapse  @if($main_manu == 'Reports') show @endif" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item @if($sub_manu == 'Sales') active @endif" href="{{ route('admin.reports.sales') }}">Sales</a>
            <a class="collapse-item @if($sub_manu == 'Purchases') active @endif" href="{{ route('admin.reports.purchases') }}">Purchases</a>
            <a class="collapse-item @if($sub_manu == 'Payments') active @endif" href="{{ route('admin.reports.payments') }}">Payments</a>
            <a class="collapse-item @if($sub_manu == 'Receipts') active @endif" href="{{ route('admin.reports.receipts') }}">Receipts</a>
          </div>
        </div>
      </li>

       <!-- Nav Item - Pages Collapse Menu -->
       <li class="nav-item @if($main_manu == 'Country/State/City') active @endif">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseAddress" aria-expanded="true" aria-controls="collapseAddress">
          <i class="fa fa-flag"></i>
          <span>Country/State/City</span>
        </a>
        <div id="collapseAddress" class="collapse  @if($main_manu == 'Country/State/City') show @endif" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item @if($sub_manu == 'Country/State') active @endif" href="{{ url('admin/country') }}">Country/State</a>
            <a class="collapse-item @if($sub_manu == 'City') active @endif" href="{{ url('admin/city') }}">City</a>
          </div>
        </div>
      </li>


      <!-- View shop frontend -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseshopUrl" aria-expanded="true" aria-controls="collapseshopUrl">
          <i class="fa fa-eye"></i>
          <span>View Shop</span>
        </a>
        <div id="collapseshopUrl" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" target = "_blank" href="{{ url('/') }}">Restaurant</a>
          </div>
        </div>
      </li>


      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>

          <!-- Topbar Search -->
          <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
            <div class="input-group">
              <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
              <div class="input-group-append">
                <button class="btn btn-primary" type="button">
                  <i class="fas fa-search fa-sm"></i>
                </button>
              </div>
            </div>
          </form>

          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">

            <!-- Nav Item - Search Dropdown (Visible Only XS) -->
            <li class="nav-item dropdown no-arrow d-sm-none">
              <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-search fa-fw"></i>
              </a>
              <!-- Dropdown - Messages -->
              <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                <form class="form-inline mr-auto w-100 navbar-search">
                  <div class="input-group">
                    <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                      <button class="btn btn-primary" type="button">
                        <i class="fas fa-search fa-sm"></i>
                      </button>
                    </div>
                  </div>
                </form>
              </div>
            </li>


            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                  @if (isset(auth('admin')->user()->name))
                      {{ auth('admin')->user()->name }}
                  @else
                      <script>
                          window.location = "/admin/login";
                      </script>
                  @endif
              </span>
                <img class="img-profile rounded-circle" src="https://source.unsplash.com/QAB-WJcbgJk/60x60">
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href={{ url('admin/profile') }}>
                  <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                  Profile
                </a>
                <a class="dropdown-item" href="#">
                  <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                  Settings
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
                </a>
              </div>
            </li>

          </ul>

        </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

          @if ( session('message') )
            <div class="alert alert-success" role="alert">
              {{ session('message') }}
            </div>
          @endif

          @yield('main_content')

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; Your Website 2020</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="{{ route('admin.logout.perform') }}">Logout</a>
          {{-- <a class="btn btn-primary" href="login">Logout</a> --}}
        </div>
      </div>
    </div>
  </div>

@stop