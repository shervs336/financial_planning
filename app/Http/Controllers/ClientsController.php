<?php

namespace App\Http\Controllers;

use App\User;

use Illuminate\Http\Request;
use Validator;

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
    public function index()
    {
        $clients = User::where('role', 'client')->paginate(10);

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
        $validator = Validator::make($request->all(), User::$rules);

        if($validator->fails())
        {
          flash()->error("There are errors in your inputs");

          return redirect(route('clients.create'))
            ->withErrors($validator)
            ->withInput();
        }

        User::create($request->input());

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
          'name' => 'required|string',
          'username' => 'required|string|unique:users,username,'.$client->id,
          'password' => 'confirmed'
        ]);

        if($validator->fails())
        {
          flash()->error("There are errors in your inputs");

          return redirect(route('clients.edit', $client->id))
            ->withErrors($validator)
            ->withInput();
        }

        if(!$request->password){
          $client->update($request->except('password'));
        } else {
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
        $client->delete();

        flash()->success('Client successfully deleted!');

        return redirect(route('clients.index'));
    }

    public function dashboard(User $client)
    {
        return view('clients.dashboard', compact('client'));
    }
}
