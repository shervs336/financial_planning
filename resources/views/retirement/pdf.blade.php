        <h1>Retirement</h1>

        <div class="row">
          <div class="col-md-6">
            <span class="text-primary">Retirement Monthly Income:</span> <span style="font-family:DejaVu Sans; sans-serif">₱</span> {{ number_format($client->retirement->monthly_income,2) }}
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
            <span class="text-primary">Projected Monthly Income Needed:</span> <span style="font-family:DejaVu Sans; sans-serif">₱</span> {{ number_format($projected_monthly = $client->retirement->monthly_income*(pow((1+($client->retirement->inflation_rate/100)),$client->retirement->retirement_age - $client->retirement->current_age )), 2) }}
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <span class="text-primary">Annual Equivalent:</span> <span style="font-family:DejaVu Sans; sans-serif">₱</span> {{ number_format($annual_value = $projected_monthly*12, 2) }}
          </div>
          <div class="col-md-6">
            <span class="text-primary">Total Retirement Fund Estimate:</span> <span style="font-family:DejaVu Sans; sans-serif">₱</span> {{ number_format($annual_value/0.1, 2) }}
          </div>
        </div>

          <hr />

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
                $months_to_save = $client->accumulation->years_to_accumulate_fund * 12;
                $payment = json_decode($client->accumulation->payment);
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
