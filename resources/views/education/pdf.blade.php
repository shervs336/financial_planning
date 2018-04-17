        <h1>Education Fund</h1>

          <div class="row">
            <div class="col-md-6">
              <span class="text-primary">Current Tuition:</span> <span style="font-family:DejaVu Sans; sans-serif">₱</span> {{ number_format($education->current_tuition,2) }}
            </div>
            <div class="col-md-6">
              <span class="text-primary">Current Child Age:</span> {{ $education->current_child_age }}
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <span class="text-primary">Child Age to Enter College:</span> {{ $education->age_to_enter_college }}
            </div>
            <div class="col-md-6">
              <span class="text-primary">Years To Save:</span> {{ $years_to_save = $education->age_to_enter_college - $education->current_child_age }}
            </div>
          </div>
          <div class="row mb-4">
            <div class="col-md-6">
              <span class="text-primary">Assumed Annual Increase in Tuition Fee:</span> {{ $education->assumed_annual_increase_tuition_fee }} %
            </div>
            <div class="col-md-6">
              <span class="text-primary">Future Annual Increase in Tuition Fee:</span> {{ $education->future_annual_increase_tuition_fee }} %
            </div>
          </div>
          <div class="row mb-4">
            <div class="col-md-6">
              <span class="text-primary">Years in College:</span> {{ $education->years_in_college }} %
            </div>
          </div>

          <hr />

          <h3>Future Tuition Value</h3>

          <table width="100%" border="1" cellspacing="0" cellpadding="2">
            <tbody>
              @for($i=1; $i<=$education->years_in_college; $i++)
              <tr>
                <td>Year {{ $i }}</td>
                @if($i == 1)
                  <td><span style="font-family:DejaVu Sans; sans-serif">₱</span> {{ number_format($future_value_tuition = $education->current_tuition*pow((1+($education->assumed_annual_increase_tuition_fee/100)),$years_to_save), 2)}}</td>
                @else
                  <td><span style="font-family:DejaVu Sans; sans-serif">₱</span> {{ number_format($future_value_tuition = $future_value_tuition*(1+($education->future_annual_increase_tuition_fee/100)), 2)}}</td>
                @endif
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
                $months_to_save = ($education->age_to_enter_college - $education->current_child_age) * 12;
                $payment = json_decode($education->payment);
              @endphp
              @for($i = 1; $i <= $months_to_save; $i++)
                <tr>
                  <td>{{ $i }}</td>
                  <td>
                    {!! isset($payment[($i - 1)]) ? "<span style='font-family:DejaVu Sans; sans-serif'>✔</span>" : "-" !!}
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
