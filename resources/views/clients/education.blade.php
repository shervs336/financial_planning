<div class="card mb-4">
  <div class="card-header">
    <a href="#" data-toggle="collapse" data-target="#educationCard">Education Fund</a>
    @if(Auth::user()->role == "admin")
      <a href="{{ route('education.create', [$client->id]) }}" class="btn btn-warning btn-sm float-right" data-toggle="tooltip" title="Add Education"><i class="fa fa-fw fa-plus"></i></a>
    @endif
  </div>
  <div class="card-body collapse" id="educationCard">
    @forelse($client->education as $key=>$education)
      <div class="card mb-2">
        <div class="card-header">
          <a href="#" data-toggle="collapse" data-target="#educationCard{{$key+1}}">Record #{{$key+1}} </a>
          @if(Auth::user()->role == "admin")
            {!! Form::open(['route' => ['education.destroy', $client->id, $education->id], 'method' => 'delete', 'class'=>'form-inline float-right']) !!}
            <a href="{{ route('education.edit', [$client->id, $education->id]) }}" class="btn btn-warning btn-sm mr-1" data-toggle="tooltip" title="Edit Education"><i class="fa fa-fw fa-pencil"></i></a>
            {!! Form::button('<i class="fa fa-fw fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-sm', 'onclick' => 'return confirm("Are you sure you want to delete this education")']) !!}
            {!! Form::close() !!}
          @endif
        </div>
        <div class="card-body collapse" id="educationCard{{$key+1}}">
          <div class="row">
            <div class="col-md-6">
              <span class="text-primary">Current Tuition:</span> {{ number_format($education->current_tuition,2) }}
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
              <span class="text-primary">Assumed Annual Increase in Tuition Fee:</span> {{ $education->years_in_college }} %
            </div>
          </div>

          <hr />

          <div class="table-responsive">
            <div class="mb-3">Future Value of Tuition</div>
            <table class="table table-bordered table-condensde">
              <tbody>
                @for($i=1; $i<=$education->years_in_college; $i++)
                <tr>
                  <td>Year {{ $i }}</td>
                  @if($i == 1)
                    <td>{{ number_format($future_value_tuition = $education->current_tuition*pow((1+($education->assumed_annual_increase_tuition_fee/100)),$years_to_save), 2)}}</td>
                  @else
                    <td>{{ number_format($future_value_tuition = $future_value_tuition*(1+($education->future_annual_increase_tuition_fee/100)), 2)}}</td>
                  @endif
                </tr>
                @endfor
              </tbody>
            </table>
          </div>
        </div>
      </div>
    @empty
      <p class="text-center">You have no education plan record yet.</p>
    @endforelse
  </div>
</div>
