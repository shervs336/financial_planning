<div class="card mb-4">
  <div class="card-header">
    <a href="#" data-toggle="collapse" data-target="#retirementCard">Retirement Fund</a>
    <a href="{{ $client->retirement ? route('retirement.edit', [$client->id, $client->retirement->id]) : route('retirement.create', [$client->id]) }}" class="btn btn-warning btn-sm float-right" data-toggle="tooltip" title="Edit Retirement"><i class="fa fa-fw fa-pencil"></i></a>
  </div>
  <div class="card-body collapse" id="retirementCard">
    @if($client->retirement)
      <div class="row">
        <div class="col-md-6">
          <span class="text-primary">Retirement Monthly Income:</span> {{ number_format($client->retirement->monthly_income,2) }}
        </div>
        <div class="col-md-6">
          <span class="text-primary">Inflation Rate:</span> {{ $client->retirement->inflation_rate }}
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
          <span class="text-primary">Current Age:</span> {{ $client->retirement->current_age }}
        </div>
        <div class="col-md-6">
          <span class="text-primary">Retirement Age:</span> {{ $client->retirement->retirement_age }}
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
          <span class="text-primary">Number of Years to Invest:</span> {{ $client->retirement->retirement_age - $client->retirement->current_age}}
        </div>
        <div class="col-md-6">
          <span class="text-primary">Projected Monthly Income Needed:</span> {{ number_format($projected_monthly = $client->retirement->monthly_income*(pow((1+($client->retirement->inflation_rate/100)),$client->retirement->retirement_age - $client->retirement->current_age )), 2) }}
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
          <span class="text-primary">Annual Equivalent:</span> {{ number_format($annual_value = $projected_monthly*12, 2) }}
        </div>
        <div class="col-md-6">
          <span class="text-primary">Total Retirement Fund Estimate:</span> {{ number_format($annual_value/0.1, 2) }}
        </div>
      </div>
    @else
      <p class="text-center">You have no retirement plan record yet.</p>
    @endif
  </div>
</div>
