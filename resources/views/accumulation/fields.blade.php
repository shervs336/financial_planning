  <div class="form-group">
    {{ Form::label('annual_increase_savings', 'Annual Increase in Savings') }}
    <div class="row">
      <div class="col">
        {{ Form::label('annual_increase_savings', '1-5 Years:', ['class' => 'text-primary']) }}
        {{ Form::text('annual_increase_savings_yr_1_5', null, ['class' => 'form-control']) }}
      </div>
      <div class="col">
        {{ Form::label('annual_increase_savings', '6-10 Years:', ['class' => 'text-primary']) }}
        {{ Form::text('annual_increase_savings_yr_6_10', null, ['class' => 'form-control']) }}
      </div>
      <div class="col">
        {!! Form::label('annual_increase_savings', '11-Up Years:', ['class' => 'text-primary']) !!}
        {{ Form::text('annual_increase_savings_yr_11_up', null, ['class' => 'form-control']) }}
      </div>
    </div>
  </div>
  <div class="form-group">
    {{ Form::label('annual_return_investment', 'Annual Return of Investment') }}
    <div class="row">
      <div class="col">
        {{ Form::label('annual_return_investment', '1-5 Years:', ['class' => 'text-primary']) }}
        {{ Form::text('annual_return_investment_yr_1_5', null, ['class' => 'form-control']) }}
      </div>
      <div class="col">
        {{ Form::label('annual_return_investment', '6-10 Years:', ['class' => 'text-primary']) }}
        {{ Form::text('annual_return_investment_yr_6_10', null, ['class' => 'form-control']) }}
      </div>
      <div class="col">
        {!! Form::label('annual_return_investments', '11-Up Years:', ['class' => 'text-primary']) !!}
        {{ Form::text('annual_return_investment_yr_11_up', null, ['class' => 'form-control']) }}
      </div>
    </div>
  </div>
  <div class="form-group">
    {{ Form::label('starting_amount_monthly', 'Starting Amount per Month') }}
    {{ Form::text('starting_amount_monthly', null, ['class' => 'form-control']) }}
  </div>
  <div class="form-group">
    {{ Form::label('start_up_fund', 'Start Up Fund') }}
    {{ Form::text('start_up_fund', null, ['class' => 'form-control']) }}
  </div>
  {{ Form::submit('Submit', ['class' => 'btn btn-success']) }}
