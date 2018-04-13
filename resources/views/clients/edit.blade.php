@extends('layouts.app')

@section('content')
  <h1>
    Clients - Edit Client
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

  {{ Form::model($client, ['route' => ['clients.update', $client->id], 'method' => 'put']) }}
    @include('clients.fields')
  {{ Form::close() }}

@endsection
