<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark shadow">
  <a class="navbar-brand" href="{{url('/')}}"><i class="fas fa-store"></i> Minimarket</a>
  <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
  <ul class="navbar-nav d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
      <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">  
              <form action="{{url('logout')}}" method="post">
                @csrf
                <button class="dropdown-item" type="submit">Logout</button>
              </form>  
          </div>
      </li>
  </ul>
</nav>