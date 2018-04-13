@extends('layouts.app')

@section('content')
  <h1>
    Retirement for <span class="text-primary">{{ $client->name }}</span>
  </h1>

  @include('flash::message')

  @if($errors->all())
    <div class="alert alert-danger">
      <ul>
      @foreach($errors->all() as $message)
        <li>{{ $message }}</li>
      @endforeach
      </ul>
    </div>
  @endif

  {{ Form::open(['route' => ['retirement.store', $client->id], 'method' => 'post']) }}
    @include('retirement.fields')
  {{ Form::close() }}

@endsection