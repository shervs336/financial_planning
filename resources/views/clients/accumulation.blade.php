<div class="card mb-4">
  <div class="card-header">
    Accumulation Fund
    <a href="{{ $client->accumulation ? route('accumulation.edit', [$client->id, $client->accumulation->id]) : route('accumulation.create', [$client->id]) }}" class="btn btn-warning btn-sm float-right"><i class="fa fa-fw fa-pencil"></i></a>
  </div>
  <div class="card-body">
    @if($client->accumulation)
      <div class="table-responsive">
        <table class="table table-bordered table-condensed">
          <thead>
            <tr>
              <th>Year</th>
              <th>1-5</th>
              <th>6-10</th>
              <th>11<i class="fa fa-fw fa-arrow-up"></i></th>
            </tr>
          </thead>
          <tbody>
              <tr>
                <td><strong><u>Annual Increase in Savings:</u></strong></td>
                <td>{{ number_format($client->accumulation->annual_increase_savings_yr_1_5, 2) }} %</td>
                <td>{{ number_format($client->accumulation->annual_increase_savings_yr_6_10, 2) }} %</td>
                <td>{{ number_format($client->accumulation->annual_increase_savings_yr_11_up, 2) }} %</td>
              </tr>
              <tr>
                <td><strong><u>Annual Return of Investment:</u></strong></td>
                <td>{{ number_format($client->accumulation->annual_return_investment_yr_1_5, 2) }} %</td>
                <td>{{ number_format($client->accumulation->annual_return_investment_yr_1_5, 2) }} %</td>
                <td>{{ number_format($client->accumulation->annual_return_investment_yr_1_5, 2) }} %</td>
              </tr>
          </tbody>
        </table>
      </div>

      <div class="row mb-2">
        <div class="col">
          <span class="text-primary">Starting Amount (per month): </span> {{ number_format($client->accumulation->starting_amount_monthly,2) }}
        </div>
        <div class="col">
          <span class="text-primary">Annual Savings: </span> {{ number_format($annual_savings = $client->accumulation->starting_amount_monthly * 12, 2) }}
        </div>
      </div>
      <div class="row mb-4">
        <div class="col">
          <span class="text-primary">Start Up Fund: </span> {{ number_format($client->accumulation->start_up_fund, 2) }}
        </div>
      </div>

      <div class="table-responsive">
        <table class="table table-bordered table-condensed">
          <thead>
            <tr>
              <th>Year</th>
              <th>Monthly Savings</th>
              <th>Annual Savings</th>
              <th>Beginning Balance</th>
              <th>Annual Return</th>
              <th>Ending Balance</th>
            </tr>
          </thead>
          <tbody>
            @for($i=1; $i<=40; $i++)
            @php
              if($i >= 1 && $i <= 5){
                $annual_increase_savings = 1+($client->accumulation->annual_increase_savings_yr_1_5/100);
                $annual_return_investment = $client->accumulation->annual_return_investment_yr_1_5/100;
              }

              if($i >= 6 && $i <= 10){
                $annual_increase_savings = 1+($client->accumulation->annual_increase_savings_yr_6_10/100);
                $annual_return_investment = $client->accumulation->annual_return_investment_yr_6_10/100;
              }

              if($i > 10){
                $annual_increase_savings = 1+($client->accumulation->annual_increase_savings_yr_11_up/100);
                $annual_return_investment = $client->accumulation->annual_return_investment_yr_11_up/100;
              }

              if($i == 1){
                $monthly_savings = $client->accumulation->starting_amount_monthly;
                $annual_savings += $client->accumulation->start_up_fund;
                $beginning_balance = $annual_savings;
                $annual_return = $annual_savings * $annual_return_investment;
                $ending_balance = $annual_savings + $annual_return;
              } else {
                $monthly_savings *= $annual_increase_savings;
                $annual_savings = $monthly_savings * 12 + $client->accumulation->start_up_fund;
                $beginning_balance = $annual_savings + $ending_balance;
                $annual_return = $beginning_balance * $annual_return_investment;
                $ending_balance = $beginning_balance + $annual_return;
              }

            @endphp
            <tr>
              <td>{{ $i }}</td>
              <td>{{ number_format($monthly_savings, 2) }}</td>
              <td>{{ number_format($annual_savings, 2) }}</td>
              <td>{{ number_format($beginning_balance, 2) }}</td>
              <td>{{ number_format($annual_return, 2) }}</td>
              <td>{{ number_format($ending_balance, 2) }}</td>
            </tr>
            @endfor
          </tbody>
        </table>
      </div>
    @else
      <p class="text-center">You have no fund accumulation fund record yet.</p>
    @endif
  </div>
</div>
