<div class="form-group">
  {{ Form::label('monthly_income', 'Monthly Income: ') }}
  {{ Form::text('monthly_income', null, ['class' => 'form-control']) }}
</div>
<div class="form-group">
  {{ Form::label('advisable_fund', 'Advisable Fund: ') }}
  {{ Form::text('advisable_fund', null, ['class' => 'form-control']) }}
</div>
<div class="form-group">
  {{ Form::label('allotment_of_income', 'Percentage of Income Committment') }}
  {{ Form::text('allotment_of_income', null, ['class' => 'form-control']) }}
</div>
{{ Form::submit('Submit', ['class' => 'btn btn-success']) }}
