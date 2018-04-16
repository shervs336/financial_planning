@extends('layouts.app')

@section('content')
  <h1>
    Admin
  </h1>

  <hr />

  @include('flash::message')

  @include('users.table')

@endsection
