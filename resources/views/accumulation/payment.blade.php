@extends('layouts.app')

@section('content')
<h1>
  Payment - Accumulation for <span class="text-primary">{{ $client->firstname }} {{ $client->lastname }}</span>
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

{{ Form::open(['route' => ['accumulation.makePayment', $client->id, $accumulation->id], 'method' => 'post', 'class' => 'mb-4']) }}
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
          $months_to_save = $client->accumulation->years_to_accumulate_fund * 12;
          $payment = json_decode($client->accumulation->payment);
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
