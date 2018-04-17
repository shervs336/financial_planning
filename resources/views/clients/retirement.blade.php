<div class="card mb-4">
  <div class="card-header">
    <a href="#" data-toggle="collapse" data-target="#retirementCard">Retirement Fund</a>
    @if(Auth::user()->role == "admin")
      @if($client->retirement)
        {!! Form::open(['route' => ['retirement.destroy', $client->id, $client->retirement->id], 'method' => 'delete', 'class'=>'form-inline float-right']) !!}
        <a href="{{ route('retirement.payment', [$client->id, $client->retirement->id]) }}" class="btn btn-info btn-sm mr-1" data-toggle="tooltip" title="Edit Payment"><i class="fa fa-fw fa-money"></i></a>
        <a href="{{ route('retirement.edit', [$client->id, $client->retirement->id]) }}" class="btn btn-warning btn-sm mr-1" data-toggle="tooltip" title="Edit Retirement"><i class="fa fa-fw fa-pencil"></i></a>
        {!! Form::button('<i class="fa fa-fw fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-sm', 'onclick' => 'return confirm("Are you sure you want to delete this retirement record")']) !!}
        {!! Form::close() !!}
      @else
        <a href="{{ route('retirement.create', [$client->id]) }}" class="btn btn-warning btn-sm float-right" data-toggle="tooltip" title="Add Retirement"><i class="fa fa-fw fa-plus"></i></a>
      @endif
    @else
      <a href="{{ route('retirement.pdf', [$client->id, $client->retirement->id]) }}" class="btn btn-warning btn-sm float-right" data-toggle="tooltip" title="Print to PDF"><i class="fa fa-fw fa-print"></i></a>
    @endif
  </div>
  <div class="card-body collapse" id="retirementCard">
    @if($client->retirement)
      <div class="row">
        <div class="col-md-6">
          <span class="text-primary">Retirement Monthly Income:</span> ₱ {{ number_format($client->retirement->monthly_income,2) }}
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
          <span class="text-primary">Projected Monthly Income Needed:</span> ₱ {{ number_format($projected_monthly = $client->retirement->monthly_income*(pow((1+($client->retirement->inflation_rate/100)),$client->retirement->retirement_age - $client->retirement->current_age )), 2) }}
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
          <span class="text-primary">Annual Equivalent:</span> ₱ {{ number_format($annual_value = $projected_monthly*12, 2) }}
        </div>
        <div class="col-md-6">
          <span class="text-primary">Total Retirement Fund Estimate:</span> ₱ {{ number_format($annual_value/0.1, 2) }}
        </div>
      </div>

      <div class="card mt-3">
        <div class="card-header">
          <a href="#" data-toggle="collapse" data-target="#retirementPaymentCard">Payments</a>
        </div>
        <div class="card-body collapse" id="retirementPaymentCard">
          @if($client->retirement)
            <div class="table-responsive">
              <table class="table table-bordered table-condensed">
                <thead>
                  <tr>
                    <th>Month</th>
                    <th>Payment</th>
                  </tr>
                </thead>
                <tbody>
                  @php
                    $months_to_save = ($client->retirement->retirement_age - $client->retirement->current_age) * 12;
                    $payment = json_decode($client->retirement->payment);
                  @endphp
                  @for($i = 1; $i <= $months_to_save; $i++)
                    <tr>
                      <td>{{ $i }}</td>
                      <td>
                        {!! isset($payment[($i - 1)]) ? "<i class='fa fa-fw fa-2x fa-check-circle text-success'></i>" : "-" !!}
                      </td>
                    </tr>
                  @endfor
                </tbody>
              </table>
            </div>
          @endif
        </div>
      </div>
    @else
      <p class="text-center">You have no retirement plan record yet.</p>
    @endif
  </div>
</div>
