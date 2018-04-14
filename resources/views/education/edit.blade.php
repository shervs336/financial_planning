@extends('layouts.app')

@section('content')
  <h1>
    Clients - Edit Client
  </h1>

  <hr />

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

  {{ Form::model($retirement, ['route' => ['retirement.update', 'client' => $client->id, 'retirement' => $client->id], 'method' => 'put']) }}
    @include('retirement.fields')
  {{ Form::close() }}

@endsection
