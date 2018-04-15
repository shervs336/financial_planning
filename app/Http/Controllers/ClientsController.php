<?php

namespace App\Http\Controllers;

use App\User;

use Illuminate\Http\Request;
use Validator;
use Auth;
use Carbon\Carbon as Carbon;

class ClientsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->request->count()){
          $clients = User::where('role', 'client')
            ->where('firstname', 'like', '%' . $request->search . '%' )
            ->orWhere('middlename', 'like', '%' . $request->search . '%' )
            ->orWhere('lastname', 'like', '%' . $request->search . '%' )
            ->paginate(10);
          $clients->appends(['search' => $request->search]);
        } else {
          $clients = User::where('role', 'client')->paginate(10);
        }

        return view('clients.index', compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('clients.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
          'firstname' => 'required|string',
          'lastname' => 'required|string',
          'username' => 'required|string|unique:users',
          'password' => 'confirmed',
          'contact_number' => 'required',
          'email_address' => 'email',
          'birthdate' => 'date',
        ]);

        if($validator->fails())
        {
          flash()->error("There are errors in your inputs");

          return redirect(route('clients.create'))
            ->withErrors($validator)
            ->withInput();
        }

        $this->log([
          'user_id' => Auth::user()->id,
          'log' => 'New Client - '.$request->firstname.' '.$request->lastname.' has successfully created.'
        ]);

        $data = $request->input();
        $data['role'] = "client";
        $data['password'] = bcrypt($request->password);

        User::create($data);

        flash()->success("Client successfully added");

        return redirect(route('clients.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $client)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $client)
    {
        return view('clients.edit', compact('client'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $client)
    {
        $validator = Validator::make($request->all(), [
          'firstname' => 'required|string',
          'lastname' => 'required|string',
          'username' => 'required|string|unique:users,username,'.$client->id,
          'password' => 'confirmed',
          'contact_number' => 'required',
          'email_address' => 'email',
          'birthdate' => 'date',
        ]);

        if($validator->fails())
        {
          flash()->error("There are errors in your inputs");

          return redirect(route('clients.edit', $client->id))
            ->withErrors($validator)
            ->withInput();
        }

        if(!$request->password){
          $diff = array_diff($request->except('_token', '_method', 'password', 'password_confirmation'), $clientArray = $client->toArray());

          if($diff){
            $log = 'Client Updated - '. $client->firstname.' '.$client->lastname . ' successfully updated <ul>';
            foreach(array_keys($diff) as $key){
              $log .= '<li>'.$client->$key.' changes to '.$request->$key.'</li>';
            }
            $log .= '</ul>';

            $this->log([
              'user_id' => Auth::user()->id,
              'log' => $log
            ]);
          }

          $data = $request->except('password', 'password_confirmation');

          $client->update($data);
        } else {

          $diff = array_diff($request->except('_token', '_method', 'password_confirmation'), $clientArray = $client->toArray());

          if($diff){
            $log = 'Client Update - '. $client->firstname.' '.$client->lastname . 'successfully updated <ul>';
            foreach(array_keys($diff) as $key){
              if($key == "password")
              {
                $log .= '<li>Update client password</li>';
                continue;
              }

              $log .= '<li>'.$client->$key.' changes to '.$request->$key.'</li>';
            }
            $log .= '</ul>';

            $this->log([
              'user_id' => Auth::user()->id,
              'log' => $log
            ]);
          }


          $data = $request->input();
          $data['password'] = bcrypt($request->password);

          $client->update($data);
        }

        flash()->success("Client successfully updated");

        return redirect(route('clients.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $client)
    {
        $this->log([
          'user_id' => Auth::user()->id,
          'log' => 'Removed Client - '.$client->firstname.' '.$client->lastname.' successfully deleted.'
        ]);

        $client->delete();

        flash()->success('Client successfully deleted!');

        return redirect(route('clients.index'));
    }

    public function dashboard(User $client)
    {
        return view('clients.dashboard', compact('client'));
    }
}
