@extends('layouts.app')

@section('content')
<h1>System Logs - {{ Auth::user()->name }}</h1>

<hr />

<div class="row">
  <div class="col">
    <div class="card mb-3">
      <div class="card-header">
        <i class="fa fa-bell-o"></i> Recent Activity</div>
      <div class="list-group list-group-flush small">
        @forelse($logs as $log)
        <a class="list-group-item list-group-item-action" href="{{ route('logs.index') }}">
          <div class="media">
            <div class="media-body">
              {!! $log->log !!}
              <div class="text-muted smaller"><i class="fa fa-fw fa-user"></i>{{ $log->user->name }} <i class="fa fa-fw fa-clock-o"></i>{{ $log->created_at->diffForHumans() }}</div>
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
      </div>
    </div>
  </div>
</div>
{{ $logs->links() }}
@endsection
