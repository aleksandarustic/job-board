<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="{{ route('dashboard') }}" class="brand-link text-center">
    <span class="brand-text font-weight-light">{{config('app.name')}}</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex justify-content-center">
      <div class="info">
        <a href="#" class="d-block"> <i class="nav-icon fa fa-user mr-2"></i>
          {{Auth::user()->name}}</a>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
        <li class="nav-item has-treeview menu-open">

          <a href="#" class="nav-link">
            <i class="nav-icon fa fa-tachometer-alt"></i>
            <p>
              Job Offers
            </p>
          </a>
          <ul class="nav nav-treeview" style="display: block;">
            <li class="nav-item">
              <a href="{{ route('job.create') }}" class="nav-link">
                <p>Create New</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('job.index') }}" class="nav-link">
                <p>List</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item">

          <a href="#" class="nav-link" onclick="event.preventDefault();
          document.getElementById('logout-form').submit();">

            <i class="nav-icon fa fa-power-off"></i>
            <p>
              Logout
            </p>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              @csrf
            </form>
          </a>

        </li>

      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>