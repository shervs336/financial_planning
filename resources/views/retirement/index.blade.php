@extends('layouts.app')

@section('content')
  <h1>
    Clients
    <a href="{{ route('clients.create') }}" class="btn btn-success float-right">Add Client</a>
  </h1>

  @include('flash::message')

  @include('clients.table')

@endsection
