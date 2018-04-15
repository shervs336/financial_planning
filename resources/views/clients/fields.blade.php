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
  @if(Auth::user()->getOriginal()['role'] == "client")
  <div class="form-group">
    {{ Form::label('birthdate', 'Birth Date: ') }}
    {{ Form::text('birthdate', isset($client->birthdate) ? $client->birthdate->format('Y-m-d'): null, ['class' => 'form-control datepicker']) }}
  </div>
  <div class="form-group">
    {{ Form::label('contact_number', 'Contact Number: ') }}
    {{ Form::text('contact_number', null, ['class' => 'form-control']) }}
  </div>
  <div class="form-group">
    {{ Form::label('email_address', 'Email Address: ') }}
    {{ Form::text('email_address', null, ['class' => 'form-control']) }}
  </div>
  @endif
  {{ Form::submit('Submit', ['class' => 'btn btn-success']) }}
