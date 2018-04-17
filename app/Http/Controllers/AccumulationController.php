<?php

namespace App\Http\Controllers;

use App\User;
use App\Accumulation;
use Illuminate\Http\Request;
use Validator;
use Auth;

class AccumulationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(User $client)
    {
        return view('accumulation.create', compact('client'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(User $client, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'annual_increase_savings_yr_1_5' => 'required|numeric',
            'annual_increase_savings_yr_6_10' => 'required|numeric',
            'annual_increase_savings_yr_11_up' => 'required|numeric',
            'annual_return_investment_yr_1_5' => 'required|numeric',
            'annual_return_investment_yr_6_10' => 'required|numeric',
            'annual_return_investment_yr_11_up' => 'required|numeric',
            'starting_amount_monthly' => 'required|numeric',
            'start_up_fund' => 'required|numeric',
            'years_to_accumulate_fund' => 'required|numeric|min:1',
        ]);

        if($validator->fails())
        {
          flash()->error("There are errors in your inputs");

          return redirect(route('accumulation.create', $client->id))
            ->withErrors($validator)
            ->withInput();
        }

        $data = $request->input();
        $data['user_id'] = $client->id;

        $this->log([
          'user_id' => Auth::user()->id,
          'log' => 'New Accumulation Record for '.$client->firstname.' '.$client->lastname.' successfully created.'
        ]);

        Accumulation::create($data);

        flash()->success("Accumulation record successfully added");

        return redirect(route('clients.dashboard', $client->id));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Accumulation  $accumulation
     * @return \Illuminate\Http\Response
     */
    public function show(Accumulation $accumulation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Accumulation  $accumulation
     * @return \Illuminate\Http\Response
     */
    public function edit(User $client, Accumulation $accumulation)
    {
        return view('accumulation.edit', compact('client', 'accumulation'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Accumulation  $accumulation
     * @return \Illuminate\Http\Response
     */
    public function update(User $client, Accumulation $accumulation, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'annual_increase_savings_yr_1_5' => 'required|numeric',
            'annual_increase_savings_yr_6_10' => 'required|numeric',
            'annual_increase_savings_yr_11_up' => 'required|numeric',
            'annual_return_investment_yr_1_5' => 'required|numeric',
            'annual_return_investment_yr_6_10' => 'required|numeric',
            'annual_return_investment_yr_11_up' => 'required|numeric',
            'starting_amount_monthly' => 'required|numeric',
            'start_up_fund' => 'required|numeric',
            'years_to_accumulate_fund' => 'required|numeric|min:1',
        ]);

        if($validator->fails())
        {
          flash()->error("There are errors in your inputs");

          return redirect(route('accumulation.edit', [$client->id, $accumulation->user_id]))
            ->withErrors($validator)
            ->withInput();
        }

        $diff = array_diff($request->except('_token', '_method'),$accumulation->toArray());
        if($diff)
        {
            $log = 'Accumulation Updated - '. $client->firstname.' '.$client->lastname.' successfully updated <ul>';
            foreach(array_keys($diff) as $key){
              $log .= '<li>'.$accumulation->$key.' changes to '.$request->$key.'</li>';
            }
            $log .= '</ul>';

            $this->log([
              'user_id' => Auth::user()->id,
              'log' => $log
            ]);
        }

        $accumulation->update($request->input());

        flash()->success("Accumulation record successfully updated");

        return redirect(route('clients.dashboard', $accumulation->user_id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Accumulation  $accumulation
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $client, Accumulation $accumulation)
    {
        $this->log([
          'user_id' => Auth::user()->id,
          'log' => 'Removed Accumulation - '.$client->firstname.' '.$client->lastname.' successfully deleted.'
        ]);

        $accumulation->delete();

        flash()->success('Accumulation successfully deleted!');

        return redirect(route('clients.dashboard', $client->id));
    }

    public function payment(User $client, Accumulation $accumulation)
    {
        return view('accumulation.payment', compact('client', 'accumulation'));
    }

    public function makePayment(User $client, Accumulation $accumulation, Request $request)
    {
      if(!$request->payment)
      {
        flash()->error("No accumulation payment input found");

        return redirect(route('accumulation.payment', [$client->id, $accumulation->id]));
      }

      $data = $request->input();
      $data['payment'] = json_encode($request->payment);

      $this->log([
        'user_id' => Auth::user()->id,
        'log' => 'Make Payment Accumulation - '.$client->firstname.' '.$client->lastname.' successfully saved.'
      ]);

      $accumulation->update($data);

      flash()->success("Accumulation payment successfully updated");

      return redirect(route('clients.dashboard', $accumulation->user_id));
    }
}
