@extends('layouts.app')

@section('content')
<h1>
  Payment - Emergency Fund for <span class="text-primary">{{ $client->firstname }} {{ $client->lastname }}</span>
</h1>

<hr />

@include('flash::message')

@if($errors->all())
  <div class="alert alert-danger">
    <ul>
    @foreach($errors->all() as $message)
      <li>{{ $message }}</li>
    @endforeach
    </ul>
  </div>
@endif

{{ Form::open(['route' => ['emergency_fund.makePayment', $client->id, $emergency_fund->id], 'method' => 'post', 'class' => 'mb-4']) }}
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
          $payment = json_decode($emergency_fund->payment);
        @endphp
        @for($i = 1; $i <= $months_to_save; $i++)
          <tr>
            <td>{{ $i }}</td>
            <td>
              <div class="checkbox">
                {{ Form::checkbox('payment[]', true, isset($payment[($i - 1)]) ? true : false) }}
              </div>
            </td>
          </tr>
        @endfor
      </tbody>
    </table>
  </div>
  {{ Form::submit('Submit Payment', ['class' => 'btn btn-success']) }}
{{ Form::close() }}
@endsection
