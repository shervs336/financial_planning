  <div class="form-group">
    {{ Form::label('monthly_income', 'Monthly Income: ') }}
    {{ Form::text('monthly_income', null, ['class' => 'form-control']) }}
  </div>
  <div class="form-group">
    {{ Form::label('inflation_rate', 'Inflation Rate: ') }}
    {{ Form::text('inflation_rate', null, ['class' => 'form-control']) }}
  </div>
  <div class="form-group">
    {{ Form::label('current_age', 'Current Age') }}
    {{ Form::text('current_age', null, ['class' => 'form-control']) }}
  </div>
  <div class="form-group">
    {{ Form::label('retirement_age', 'Retirement Age') }}
    {{ Form::text('retirement_age', null, ['class' => 'form-control']) }}
  </div>
  {{ Form::submit('Submit', ['class' => 'btn btn-success']) }}
