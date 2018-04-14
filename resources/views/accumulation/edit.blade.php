@extends('layouts.app')

@section('content')
  <h1>
    Edit - Fund Accumulation for <span class="text-primary">{{ $client->name }}</span>
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

  {{ Form::model($accumulation, ['route' => ['accumulation.update', 'client' => $client->id, 'accumulation' => $client->accumulation->id], 'method' => 'put']) }}
    @include('accumulation.fields')
  {{ Form::close() }}

@endsection
