<ul class="navbar-nav ml-auto">
  @if(Auth::user()->role == "admin")
  <li class="nav-item">
    {{ Form::open(['route' => 'clients.index', 'method' => 'get', 'class' => 'form-inline my-2 my-lg-0 mr-lg-2']) }}
    <div class="input-group">
      {{ Form::text('search', null,['class' => 'form-control', 'placeholder' => 'Search for a client...']) }}
      <span class="input-group-append">
        {!! Form::button('<i class="fa fa-search"></i>', ['type' => 'submit', 'class' => 'btn btn-primary']) !!}
      </span>
    </div>
    {{ Form::close() }}
  </li>
  @endif
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
