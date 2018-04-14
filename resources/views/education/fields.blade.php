<div class="form-group">
  {{ Form::label('current_tuition', 'Current Tuition: ') }}
  {{ Form::text('current_tuition', null, ['class' => 'form-control']) }}
</div>
<div class="form-group">
  {{ Form::label('current_child_age', 'Current Child Age: ') }}
  {{ Form::text('current_child_age', null, ['class' => 'form-control']) }}
</div>
<div class="form-group">
  {{ Form::label('age_to_enter_college', 'Age to Enter College') }}
  {{ Form::text('age_to_enter_college', null, ['class' => 'form-control']) }}
</div>
<div class="form-group">
  {{ Form::label('assumed_annual_increase_tuition_fee', 'Assumed Annual Increase in Tuition Fee') }}
  {{ Form::text('assumed_annual_increase_tuition_fee', null, ['class' => 'form-control']) }}
</div>
<div class="form-group">
  {{ Form::label('future_annual_increase_tuition_fee', 'Future Annual Increase in Tuition Fee') }}
  {{ Form::text('future_annual_increase_tuition_fee', null, ['class' => 'form-control']) }}
</div>
{{ Form::submit('Submit', ['class' => 'btn btn-success']) }}
