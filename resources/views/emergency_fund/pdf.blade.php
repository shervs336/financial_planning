        <h1>Emergency Fund</h1>

          <div class="row mb-2">
            <div class="col-md-6">
              <span class="text-primary">Monthly Income: </span> <span style="font-family:DejaVu Sans; sans-serif">₱</span> {{ number_format($client->emergency_fund->monthly_income,2) }}
            </div>
            <div class="col-md-6">
              <span class="text-primary">Advisable Funds: </span> <span style="font-family:DejaVu Sans; sans-serif">₱</span> {{ number_format($client->emergency_fund->advisable_fund, 2) }}
            </div>
          </div>
          <div class="row mb-2">
            <div class="col-md-6">
              <span class="text-primary">Percentage of Income Committment: </span> {{ number_format($client->emergency_fund->allotment_of_income,2) }} %
            </div>
            <div class="col-md-6">
              <span class="text-primary">Required Monthly Savings: </span> <span style="font-family:DejaVu Sans; sans-serif">₱</span> {{ number_format($monthly_savings = $client->emergency_fund->monthly_income * ($client->emergency_fund->allotment_of_income/100),2) }}
            </div>
          </div>
          <div class="row mb-2">
            <div class="col-md-12">
              <span class="text-primary">Number of Months to Save: </span> {{ floor($client->emergency_fund->advisable_fund / $monthly_savings) }}
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
