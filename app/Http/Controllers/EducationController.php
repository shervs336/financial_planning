<?php

namespace App\Http\Controllers;

use App\User;
use App\Education;
use Illuminate\Http\Request;
use Validator;

class EducationController extends Controller
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
        return view('education.create', compact('client'));
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
            'current_tuition' => 'required|numeric',
            'current_child_age' => 'required|numeric',
            'age_to_enter_college' => 'required|numeric',
            'assumed_annual_increase_tuition_fee' => 'required|numeric',
            'future_annual_increase_tuition_fee' => 'required|numeric'
        ]);

        if($validator->fails())
        {
          flash()->error("There are errors in your inputs");

          return redirect(route('education.create', $client->id))
            ->withErrors($validator)
            ->withInput();
        }

        $data = $request->input();
        $data['user_id'] = $client->id;

        Education::create($data);

        flash()->success("Education record successfully added");

        return redirect(route('clients.dashboard', $client->id));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Education  $Education
     * @return \Illuminate\Http\Response
     */
    public function show(Education $education)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Education  $education
     * @return \Illuminate\Http\Response
     */
    public function edit(User $client, Education $education)
    {
        return view('education.edit', compact('client', 'education'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Education  $education
     * @return \Illuminate\Http\Response
     */
    public function update(User $client, Education $education, Request $request)
    {
        $validator = Validator::make($request->all(), [
          'current_tuition' => 'required|numeric',
          'current_child_age' => 'required|numeric',
          'age_to_enter_college' => 'required|numeric',
          'assumed_annual_increase_tuition_fee' => 'required|numeric',
          'future_annual_increase_tuition_fee' => 'required|numeric'
        ]);

        if($validator->fails())
        {
          flash()->error("There are errors in your inputs");

          return redirect(route('Education.edit', $education->user_id))
            ->withErrors($validator)
            ->withInput();
        }

        $education->update($request->input());

        flash()->success("Retirement record successfully updated");

        return redirect(route('clients.dashboard', $education->user_id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Education  $education
     * @return \Illuminate\Http\Response
     */
    public function destroy(Education $education)
    {
        //
    }
}
