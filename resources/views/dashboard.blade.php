@extends('layouts.app')

@section('content')
<h1>Admin Dashboard - {{ Auth::user()->name }}</h1>

<hr />

<!-- Dashboard Cards -->
<div class="row">
  <div class="col-xl-3 col-sm-6 mb-3">
    <div class="card text-white bg-primary o-hidden h-100">
      <div class="card-body">
        <div class="card-body-icon">
          <i class="fa fa-fw fa-wheelchair"></i>
        </div>
        <div class="mr-5">{{ $retirements }} Retirement</div>
      </div>
      <a class="card-footer text-white clearfix small z-1" href="{{ route('clients.index') }}">
        <span class="float-left">View Details</span>
        <span class="float-right">
          <i class="fa fa-angle-right"></i>
        </span>
      </a>
    </div>
  </div>

  <div class="col-xl-3 col-sm-6 mb-3">
    <div class="card text-white bg-success o-hidden h-100">
      <div class="card-body">
        <div class="card-body-icon">
          <i class="fa fa-fw fa-line-chart"></i>
        </div>
        <div class="mr-5">{{ $accumulations }} Fund Accumulations</div>
      </div>
      <a class="card-footer text-white clearfix small z-1" href="{{ route('clients.index') }}">
        <span class="float-left">View Details</span>
        <span class="float-right">
          <i class="fa fa-angle-right"></i>
        </span>
      </a>
    </div>
  </div>

  <div class="col-xl-3 col-sm-6 mb-3">
    <div class="card text-white bg-danger o-hidden h-100">
      <div class="card-body">
        <div class="card-body-icon">
          <i class="fa fa-fw fa-graduation-cap"></i>
        </div>
        <div class="mr-5">{{ $educations }} Education</div>
      </div>
      <a class="card-footer text-white clearfix small z-1" href="{{ route('clients.index') }}">
        <span class="float-left">View Details</span>
        <span class="float-right">
          <i class="fa fa-angle-right"></i>
        </span>
      </a>
    </div>
  </div>

  <div class="col-xl-3 col-sm-6 mb-3">
    <div class="card text-white bg-warning o-hidden h-100">
      <div class="card-body">
        <div class="card-body-icon">
          <i class="fa fa-fw fa-life-bouy"></i>
        </div>
        <div class="mr-5">{{ $emergency_funds }} Emergency Fund</div>
      </div>
      <a class="card-footer text-white clearfix small z-1" href="{{ route('clients.index') }}">
        <span class="float-left">View Details</span>
        <span class="float-right">
          <i class="fa fa-angle-right"></i>
        </span>
      </a>
    </div>
  </div>
</div>

<div class="row">
  <div class="col">
    <div class="card mb-3">
      <div class="card-header">
        <i class="fa fa-bell-o"></i> Activity Logs</div>
      <div class="list-group list-group-flush small">
        @forelse($logs as $log)
        <a class="list-group-item list-group-item-action" href="#">
          <div class="media">
            <div class="media-body">
              {!! $log->log !!}
              <div class="text-muted smaller">{{ $log->created_at->diffForHumans() }}</div>
            </div>
          </div>
        </a>
        @empty
        <a class="list-group-item list-group-item-action" href="#">
          <div class="media">
            <div class="media-body">
              <p class="text-center">- No Activity Logs Found -</p>
            </div>
          </div>
        </a>
        @endforelse
        <a class="list-group-item list-group-item-action" href="#">View all activity...</a>
      </div>
    </div>
  </div>
</div>
@endsection
