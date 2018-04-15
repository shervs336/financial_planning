@extends('layouts.app')

@section('content')
  <h1>
  Users - Add User
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

  {{ Form::open(['route' => 'users.store', 'method' => 'post']) }}
    @include('users.fields')
  {{ Form::close() }}

@endsection
