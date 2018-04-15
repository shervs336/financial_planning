@extends('layouts.app')

@section('content')
  <h1>
    Edit - Education for <span class="text-primary">{{ $client->name }}</span>
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

  {{ Form::model($education, ['route' => ['education.update', 'client' => $client->id, 'education' => $education->id], 'method' => 'put']) }}
    @include('education.fields')
  {{ Form::close() }}

@endsection
