@extends('layouts.app')

@section('content')
  <h1>
    Create - Emergency Fund for <span class="text-primary">{{ $client->name }}</span>
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

  {{ Form::open(['route' => ['emergency_fund.store', $client->id], 'method' => 'post']) }}
    @include('emergency_fund.fields')
  {{ Form::close() }}

@endsection
