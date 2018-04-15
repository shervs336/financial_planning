  <div class="form-group">
    {{ Form::label('firstname', 'First Name: ') }}
    {{ Form::text('firstname', null, ['class' => 'form-control']) }}
  </div>
  <div class="form-group">
    {{ Form::label('middlename', 'Middle Name: ') }}
    {{ Form::text('middlename', null, ['class' => 'form-control']) }}
  </div>
  <div class="form-group">
    {{ Form::label('lastname', 'Last Name: ') }}
    {{ Form::text('lastname', null, ['class' => 'form-control']) }}
  </div>
  <div class="form-group">
    {{ Form::label('username', 'Username: ') }}
    {{ Form::text('username', null, ['class' => 'form-control']) }}
  </div>
  <div class="form-group">
    {{ Form::label('password', 'Password') }}
    {{ Form::password('password', ['class' => 'form-control']) }}
  </div>
  <div class="form-group">
    {{ Form::label('password_confirmation', 'Confirm Password') }}
    {{ Form::password('password_confirmation', ['class' => 'form-control']) }}
  </div>
  {{ Form::submit('Submit', ['class' => 'btn btn-success']) }}
