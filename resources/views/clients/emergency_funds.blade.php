<div class="card mb-4">
  <div class="card-header">
    <a href="#" data-toggle="collapse" data-target="#emergencyFundCard">Emergency Funds</a>
    @if(Auth::user()->role == "admin")
      @if($client->emergency_fund)
        {!! Form::open(['route' => ['emergency_fund.destroy', $client->id, $client->emergency_fund->id], 'method' => 'delete', 'class'=>'form-inline float-right']) !!}
        <a href="{{ route('emergency_fund.payment', [$client->id, $client->emergency_fund->id]) }}" class="btn btn-info btn-sm mr-1" data-toggle="tooltip" title="Edit Payment"><i class="fa fa-fw fa-money"></i></a>
        <a href="{{ route('emergency_fund.edit', [$client->id, $client->emergency_fund->id]) }}" class="btn btn-warning btn-sm mr-1" data-toggle="tooltip" title="Edit Emergency Fund"><i class="fa fa-fw fa-pencil"></i></a>
        {!! Form::button('<i class="fa fa-fw fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-sm', 'onclick' => 'return confirm("Are you sure you want to delete this emergency fund record")']) !!}
        {!! Form::close() !!}
      @else
        <a href="{{ route('emergency_fund.create', [$client->id]) }}" class="btn btn-warning btn-sm float-right" data-toggle="tooltip" title="Add Emergency Fund"><i class="fa fa-fw fa-plus"></i></a>
      @endif
    @endif
  </div>
  <div class="card-body collapse" id="emergencyFundCard">
    @if($client->emergency_fund)
      <div class="row mb-2">
        <div class="col-md-6">
          <span class="text-primary">Monthly Income: </span> ₱ {{ number_format($client->emergency_fund->monthly_income,2) }}
        </div>
        <div class="col-md-6">
          <span class="text-primary">Advisable Funds: </span> ₱ {{ number_format($client->emergency_fund->advisable_fund, 2) }}
        </div>
      </div>
      <div class="row mb-2">
        <div class="col-md-6">
          <span class="text-primary">Percentage of Income Committment: </span> {{ number_format($client->emergency_fund->allotment_of_income,2) }} %
        </div>
        <div class="col-md-6">
          <span class="text-primary">Required Monthly Savings: </span> ₱ {{ number_format($monthly_savings = $client->emergency_fund->monthly_income * ($client->emergency_fund->allotment_of_income/100),2) }}
        </div>
      </div>
      <div class="row mb-2">
        <div class="col-md-12">
          <span class="text-primary">Number of Months to Save: </span> {{ floor($client->emergency_fund->advisable_fund / $monthly_savings) }}
        </div>
      </div>

      <div class="card">
        <div class="card-header">
          <a href="#" data-toggle="collapse" data-target="#emergencyFundPaymentCard">Payments</a>
        </div>
        <div class="card-body collapse" id="emergencyFundPaymentCard">
          @if($client->emergency_fund->payment)
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
                    $monthly_savings = $client->emergency_fund->monthly_income * ($client->emergency_fund->allotment_of_income/100);
                    $months_to_save = floor($client->emergency_fund->advisable_fund / $monthly_savings);
                    $payment = json_decode($client->emergency_fund->payment);
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
      <p class="text-center">You have no fund emergency fund record yet.</p>
    @endif
  </div>
</div>
