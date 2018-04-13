<ul class="navbar-nav ml-auto">
  <li class="nav-item">
    <form class="form-inline my-2 my-lg-0 mr-lg-2">
      <div class="input-group">
        <input class="form-control" type="text" placeholder="Search for...">
        <span class="input-group-append">
          <button class="btn btn-primary" type="button">
            <i class="fa fa-search"></i>
          </button>
        </span>
      </div>
    </form>
  </li>
  <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle mr-lg-2" id="alertsDropdown" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
            <i class="fa fa-fw fa-user"></i> {{ Auth::user()->name }}
          </a>
          <div class="dropdown-menu" aria-labelledby="alertsDropdown">
            <a href="{{ route('logout') }}" class="dropdown-item"
                onclick="event.preventDefault();
                         document.getElementById('logout-form').submit();">
                <i class="fa fa-sign-out"></i> Logout
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>
          </div>
        </li>
  <li class="nav-item dropdown">
  </li>
</ul>
