@extends('layouts.app')

@section('content')
  <h1>Dashboard of <span class="text-primary">{{ $client->name }}</span></h1>

      @include('flash::message')

      <div class="card mb-4">
        <div class="card-header">
          Retirement Fund
          <a href="{{ $client->retirement ? route('retirement.edit', [$client->id, $client->id]) : route('retirement.create', [$client->id]) }}" class="btn btn-warning btn-sm float-right"><i class="fa fa-fw fa-pencil"></i></a>
        </div>
        <div class="card-body">
          @if($client->retirement)

          @else
            <p class="text-center">You have no retirement plan record yet.</p>
          @endif
        </div>
      </div>



      <div class="card mb-4">
        <div class="card-header">
          Educational Fund
        </div>
        <div class="card-body">
          @if($client->retirement)

          @else
            <p class="text-center">You have no retirement plan record yet.</p>
          @endif
        </div>
      </div>



      <div class="card mb-4">
        <div class="card-header">
          Accumulation Fund
        </div>
        <div class="card-body">
          @if($client->retirement)

          @else
            <p class="text-center">You have no retirement plan record yet.</p>
          @endif
        </div>
      </div>

@endsection
