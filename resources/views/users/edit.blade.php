@extends('layouts.app')

@section('content')
  <h1>
    Users - Edit User
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

  {{ Form::model($user, ['route' => ['users.update', $user->id], 'method' => 'put']) }}
    @include('users.fields')
  {{ Form::close() }}

@endsection
