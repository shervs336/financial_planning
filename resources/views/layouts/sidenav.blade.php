<ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
  <li class="nav-item" data-toggle="tooltip" data-placement="right" title="" data-original-title="Dashboard">
    <a class="nav-link" href="{{ Auth::user()->role == 'admin' ? route('dashboard') : route('clients.dashboard', Auth::user()->id) }}">
      <i class="fa fa-fw fa-dashboard"></i>
      <span class="nav-link-text">Dashboard</span>
    </a>
  </li>
  @if(Auth::user()->role == "admin")
  <li class="nav-item" data-toggle="tooltip" data-placement="right" title="" data-original-title="Charts">
    <a class="nav-link" href="{{ route('clients.index') }}">
      <i class="fa fa-fw fa-users"></i>
      <span class="nav-link-text">Clients</span>
    </a>
  </li>
  <li class="nav-item" data-toggle="tooltip" data-placement="right" title="" data-original-title="Charts">
    <a class="nav-link" href="{{ route('export') }}">
      <i class="fa fa-fw fa-download"></i>
      <span class="nav-link-text">Backup Database</span>
    </a>
  </li>
  <li class="nav-item" data-toggle="tooltip" data-placement="right" title="" data-original-title="Charts">
    <a class="nav-link" href="{{ route('showImport') }}">
      <i class="fa fa-fw fa-upload"></i>
      <span class="nav-link-text">Restore Database</span>
    </a>
  </li>
  @endif
</ul>
<ul class="navbar-nav sidenav-toggler">
  <li class="nav-item">
    <a class="nav-link text-center" id="sidenavToggler">
      <i class="fa fa-fw fa-angle-left"></i>
    </a>
  </li>
</ul>
