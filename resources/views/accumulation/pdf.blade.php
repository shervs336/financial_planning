        <h1>Accumulation</h1>

        <table width="100%" border="1" cellspacing="0" cellpadding="2">
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

        <div class="row mb-2" style="margin-top:15px;">
          <div class="col">
            <span class="text-primary">Starting Amount (per month): </span> <span style="font-family:DejaVu Sans; sans-serif">₱</span> {{ number_format($client->accumulation->starting_amount_monthly,2) }}
          </div>
          <div class="col">
            <span class="text-primary">Annual Savings: </span> <span style="font-family:DejaVu Sans; sans-serif">₱</span> {{ number_format($annual_savings = $client->accumulation->starting_amount_monthly * 12, 2) }}
          </div>
        </div>
        <div class="row mb-4">
          <div class="col">
            <span class="text-primary">Start Up Fund: </span> <span style="font-family:DejaVu Sans; sans-serif">₱</span> {{ number_format($client->accumulation->start_up_fund, 2) }}
          </div>
        </div>

          <hr />

          <h3>Yearly Accumulation Table</h3>

          <table width="100%" border="1" cellspacing="0" cellpadding="2">
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
              @for($i=1; $i<=$client->accumulation->years_to_accumulate_fund; $i++)
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
                <td><span style="font-family:DejaVu Sans; sans-serif">₱</span> {{ number_format($monthly_savings, 2) }}</td>
                <td><span style="font-family:DejaVu Sans; sans-serif">₱</span> {{ number_format($annual_savings, 2) }}</td>
                <td><span style="font-family:DejaVu Sans; sans-serif">₱</span> {{ number_format($beginning_balance, 2) }}</td>
                <td><span style="font-family:DejaVu Sans; sans-serif">₱</span> {{ number_format($annual_return, 2) }}</td>
                <td><span style="font-family:DejaVu Sans; sans-serif">₱</span> {{ number_format($ending_balance, 2) }}</td>
              </tr>
              @endfor
            </tbody>
          </table>

          <h3>Payment Made</h3>

          <table width="100%" border="1" cellspacing="0" cellpadding="2">
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

          <br />
          <br />
          <br />
          <br />

          <div>
            <div style="width: 50%; float:left">
              <div style="width: 200px; border-top: 1px solid black; text-align: center;">Applicant Signature</div>
            </div>
            <div style="width: 50%; float:left">
              <div style="width: 200px; border-top: 1px solid black; text-align: center; float:right">Branch Manager Signature</div>
            </div>
          </div>
