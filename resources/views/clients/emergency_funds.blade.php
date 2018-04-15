<div class="card mb-4">
  <div class="card-header">
    <a href="#" data-toggle="collapse" data-target="#emergencyFundCard">Emergency Funds</a>
    @if($client->emergency_fund)
      {!! Form::open(['route' => ['emergency_fund.destroy', $client->id, $client->emergency_fund->id], 'method' => 'delete', 'class'=>'form-inline float-right']) !!}
      <a href="{{ route('emergency_fund.edit', [$client->id, $client->emergency_fund->id]) }}" class="btn btn-warning btn-sm mr-1" data-toggle="tooltip" title="Edit Emergency Fund"><i class="fa fa-fw fa-pencil"></i></a>
      {!! Form::button('<i class="fa fa-fw fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-sm', 'onclick' => 'return confirm("Are you sure you want to delete this emergency fund record")']) !!}
      {!! Form::close() !!}
    @else
      <a href="{{ route('emergency_fund.create', [$client->id]) }}" class="btn btn-warning btn-sm float-right" data-toggle="tooltip" title="Add Emergency Fund"><i class="fa fa-fw fa-plus"></i></a>
    @endif
  </div>
  <div class="card-body collapse" id="emergencyFundCard">
    @if($client->emergency_fund)
      <div class="row mb-2">
        <div class="col-md-6">
          <span class="text-primary">Monthly Income: </span> {{ number_format($client->emergency_fund->monthly_income,2) }}
        </div>
        <div class="col-md-6">
          <span class="text-primary">Advisable Funds: </span> {{ number_format($client->emergency_fund->advisable_fund, 2) }}
        </div>
      </div>
      <div class="row mb-2">
        <div class="col-md-6">
          <span class="text-primary">Percentage of Income Committment: </span> {{ number_format($client->emergency_fund->allotment_of_income,2) }} %
        </div>
        <div class="col-md-6">
          <span class="text-primary">Required Monthly Savings: </span> {{ number_format($monthly_savings = $client->emergency_fund->monthly_income * (1+($client->emergency_fund->allotment_of_income/100)),2) }}
        </div>
      </div>
      <div class="row mb-2">
        <div class="col-md-12">
          <span class="text-primary">Number of Months to Save: </span> {{ floor($client->emergency_fund->advisable_fund / $monthly_savings) }}
        </div>
      </div>
    @else
      <p class="text-center">You have no fund emergency fund record yet.</p>
    @endif
  </div>
</div>
