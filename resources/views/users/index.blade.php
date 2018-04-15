@extends('layouts.app')

@section('content')
  <h1>
    Users
    <a href="{{ route('users.create') }}" class="btn btn-success float-right">Add User</a>
  </h1>

  <hr />

  @include('flash::message')

  @include('users.table')

@endsection
