@extends('layouts.app')

@section('content')
  <h1>Dashboard of <span class="text-primary">{{ $client->firstname }} {{ $client->lastname }}</span></h1>

  <hr />

  @include('flash::message')

  @include('clients.retirement')

  @include('clients.education')

  @include('clients.accumulation')

  @include('clients.emergency_funds')

@endsection
