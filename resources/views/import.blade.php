@extends('layouts.app')

@section('content')
<h1>Restore Database</h1>

<hr />

{{ Form::open(['route' => 'import', 'method' => 'post', 'enctype' => 'multipart/form-data']) }}
  <div class="form-group">
  {{ Form::label('file', 'File to Restore') }}
  {{ Form::file('file', ['class' => 'form-control'])}}
  </div>
  {{ Form::submit('Start Database Restoration', ['class' => 'btn btn-success']) }}
{{ Form::close() }}

@endsection
