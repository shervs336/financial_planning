@extends('layouts.app')

@section('content')
  <h1>
    Edit - Emergency Fund for <span class="text-primary">{{ $client->firstname }} {{ $client->lastname }}</span>
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

  {{ Form::model($emergency_fund, ['route' => ['emergency_fund.update', 'client' => $client->id, 'Emergency Fund' => $client->emergency_fund->id], 'method' => 'put']) }}
    @include('emergency_fund.fields')
  {{ Form::close() }}

@endsection
