<?php

namespace App\Http\Controllers;

use App\User;
use App\Retirement;
use Illuminate\Http\Request;
use Validator;
use Auth;

class RetirementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(User $client)
    {
        return view('retirement.create', compact('client'));
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
            'inflation_rate' => 'required|numeric',
            'current_age' => 'required|numeric',
            'retirement_age' => 'required|numeric'
        ]);

        if($validator->fails())
        {
          flash()->error("There are errors in your inputs");

          return redirect(route('retirement.create', $client->id))
            ->withErrors($validator)
            ->withInput();
        }

        $data = $request->input();
        $data['user_id'] = $client->id;

        Retirement::create($data);

        $this->log([
          'user_id' => Auth::user()->id,
          'log' => 'New Retirement Record for '.$request->name.' successfully created.'
        ]);

        flash()->success("Retirement record successfully added");

        return redirect(route('clients.dashboard', $client->id));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Retirement  $retirement
     * @return \Illuminate\Http\Response
     */
    public function show(Retirement $retirement)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Retirement  $retirement
     * @return \Illuminate\Http\Response
     */
    public function edit(User $client, Retirement $retirement)
    {
        return view('retirement.edit', compact('client', 'retirement'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Retirement  $retirement
     * @return \Illuminate\Http\Response
     */
    public function update(User $client, Retirement $retirement, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'monthly_income' => 'required|numeric',
            'inflation_rate' => 'required|numeric',
            'current_age' => 'required|numeric',
            'retirement_age' => 'required|numeric'
        ]);

        if($validator->fails())
        {
          flash()->error("There are errors in your inputs");

          return redirect(route('retirement.edit', $retirement->user_id))
            ->withErrors($validator)
            ->withInput();
        }

        $diff = array_diff($request->except('_token', '_method'),$retirement->toArray());
        if($diff)
        {
            $log = 'Retirement Updated - '. $client->name.' successfully updated <ul>';
            foreach(array_keys($diff) as $key){
              $log .= '<li>'.$retirement->$key.' changes to '.$request->$key.'</li>';
            }
            $log .= '</ul>';

            $this->log([
              'user_id' => Auth::user()->id,
              'log' => $log
            ]);
        }

        $retirement->update($request->input());

        flash()->success("Retirement record successfully updated");

        return redirect(route('clients.dashboard', $retirement->user_id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Retirement  $retirement
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $client, Retirement $retirement)
    {
        $this->log([
          'user_id' => Auth::user()->id,
          'log' => 'Removed Retirement - '.$client->name.' successfully deleted.'
        ]);

        $retirement->delete();

        flash()->success('Retirement successfully deleted!');

        return redirect(route('clients.dashboard', $client->id));
    }
}
