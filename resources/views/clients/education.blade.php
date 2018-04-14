<div class="card mb-4">
  <div class="card-header">
    Educational Fund
    <a href="{{ $client->education ? route('education.edit', [$client->id, $client->education->id]) : route('education.create', [$client->id]) }}" class="btn btn-warning btn-sm float-right"><i class="fa fa-fw fa-pencil"></i></a>
  </div>
  <div class="card-body">
    @if($client->education)
      <div class="row">
        <div class="col-md-6">
          <span class="text-primary">Current Tuition:</span> {{ number_format($client->education->current_tuition,2) }}
        </div>
        <div class="col-md-6">
          <span class="text-primary">Current Child Age:</span> {{ $client->education->current_child_age }}
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
          <span class="text-primary">Child Age to Enter College:</span> {{ $client->education->age_to_enter_college }}
        </div>
        <div class="col-md-6">
          <span class="text-primary">Years To Save:</span> {{ $years_to_save = $client->education->age_to_enter_college - $client->education->current_child_age }}
        </div>
      </div>
      <div class="row mb-4">
        <div class="col-md-6">
          <span class="text-primary">Assumed Annual Increase in Tuition Fee:</span> {{ $client->education->assumed_annual_increase_tuition_fee }} %
        </div>
        <div class="col-md-6">
          <span class="text-primary">Future Annual Increase in Tuition Fee:</span> {{ $client->education->future_annual_increase_tuition_fee }} %
        </div>
      </div>

      <hr />

      <div class="table-responsive">
        <div class="mb-3">Future Value of Tuition</div>
        <table class="table table-bordered table-condensde">
          <tbody>
            @for($i=1; $i<=5; $i++)
            <tr>
              <td>Year {{ $i }}</td>
              @if($i == 1)
                <td>{{ number_format($future_value_tuition = $client->education->current_tuition*pow((1+($client->education->assumed_annual_increase_tuition_fee/100)),$years_to_save), 2)}}</td>
              @else
                <td>{{ number_format($future_value_tuition = $future_value_tuition*(1+($client->education->future_annual_increase_tuition_fee/100)), 2)}}</td>
              @endif
            </tr>
            @endfor
          </tbody>
        </table>
      </div>
    @else
      <p class="text-center">You have no education plan record yet.</p>
    @endif
  </div>
</div>
