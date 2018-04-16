<?php

namespace App\Http\Controllers;

use App\User;
use App\EmergencyFund;
use Illuminate\Http\Request;
use Validator;
use Auth;

class EmergencyFundController extends Controller
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
        return view('emergency_fund.create', compact('client'));
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
          'monthly_income' => 'required|numeric',
          'advisable_fund' => 'required|numeric',
          'allotment_of_income' => 'required|numeric'
        ]);

        if($validator->fails())
        {
          flash()->error("There are errors in your inputs");

          return redirect(route('emergency_fund.create', $client->id))
            ->withErrors($validator)
            ->withInput();
        }

        $data = $request->input();
        $data['user_id'] = $client->id;

        $this->log([
          'user_id' => Auth::user()->id,
          'log' => 'New Emergency Fund Record for '.$client->firstname.' '.$client->lastname.' successfully created.'
        ]);

        EmergencyFund::create($data);

        flash()->success("Emergency fund record successfully added");

        return redirect(route('clients.dashboard', $client->id));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\emergency_fund  $emergency_fund
     * @return \Illuminate\Http\Response
     */
    public function show(EmergencyFund $emergency_fund)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\emergency_fund  $emergency_fund
     * @return \Illuminate\Http\Response
     */
    public function edit(User $client, EmergencyFund $emergency_fund)
    {
        return view('emergency_fund.edit', compact('client', 'emergency_fund'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\emergency_fund  $emergency_fund
     * @return \Illuminate\Http\Response
     */
    public function update(User $client, EmergencyFund $emergency_fund, Request $request)
    {
        $validator = Validator::make($request->all(), [
          'monthly_income' => 'required|numeric',
          'advisable_fund' => 'required|numeric',
          'allotment_of_income' => 'required|numeric'
        ]);

        if($validator->fails())
        {
          flash()->error("There are errors in your inputs");

          return redirect(route('emergency_fund.edit', [$client->id, $emergency_fund->user_id]))
            ->withErrors($validator)
            ->withInput();
        }

        $diff = array_diff($request->except('_token', '_method'),$emergency_fund->toArray());
        if($diff)
        {
            $log = 'Emergency Fund Updated - '. $client->firstname.' '.$client->lastname.' successfully updated <ul>';
            foreach(array_keys($diff) as $key){
              $log .= '<li>'.$emergency_fund->$key.' changes to '.$request->$key.'</li>';
            }
            $log .= '</ul>';

            $this->log([
              'user_id' => Auth::user()->id,
              'log' => $log
            ]);
        }

        $emergency_fund->update($request->input());

        flash()->success("Emergency fund record successfully updated");

        return redirect(route('clients.dashboard', $emergency_fund->user_id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\emergency_fund  $emergency_fund
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $client, EmergencyFund $emergency_fund)
    {
        $this->log([
          'user_id' => Auth::user()->id,
          'log' => 'Removed Emergency Fund - '.$client->firstname.' '.$client->lastname.' successfully deleted.'
        ]);

        $emergency_fund->delete();

        flash()->success('Emergency fund successfully deleted!');

        return redirect(route('clients.dashboard', $client->id));
    }
}
