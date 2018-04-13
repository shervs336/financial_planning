@extends('layouts.app')

@section('content')
  <h1>
    Clients - Add Client
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

  {{ Form::open(['route' => 'clients.store', 'method' => 'post']) }}
    @include('clients.fields')
  {{ Form::close() }}

@endsection
