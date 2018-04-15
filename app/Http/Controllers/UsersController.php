<?php

namespace App\Http\Controllers;

use App\User;

use Illuminate\Http\Request;
use Validator;
use Auth;

class UsersController extends Controller
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

      $users = User::where('role', 'admin')->paginate(10);

      return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
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

          return redirect(route('users.create'))
            ->withErrors($validator)
            ->withInput();
        }

        $this->log([
          'user_id' => Auth::user()->id,
          'log' => 'New User - '.$request->name.' has successfully created.'
        ]);

        $data = $request->input();
        $data['role'] = "admin";
        $data['password'] = bcrypt($request->password);

        User::create($data);

        flash()->success("User successfully added");

        return redirect(route('users.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $validator = Validator::make($request->all(), [
          'name' => 'required|string',
          'username' => 'required|string|unique:users,username,'.$user->id,
          'password' => 'confirmed'
        ]);

        if($validator->fails())
        {
          flash()->error("There are errors in your inputs");

          return redirect(route('users.edit', $user->id))
            ->withErrors($validator)
            ->withInput();
        }

        if(!$request->password){
          $diff = array_diff($request->except('_token', '_method', 'password', 'password_confirmation'), $user->toArray());

          if($diff){
            $log = 'User Updated - '. $user->name . ' successfully updated <ul>';
            foreach(array_keys($diff) as $key){
              $log .= '<li>'.$user->$key.' changes to '.$request->$key.'</li>';
            }
            $log .= '</ul>';

            $this->log([
              'user_id' => Auth::user()->id,
              'log' => $log
            ]);
          }

          $user->update($request->except('password'));
        } else {

          $diff = array_diff($request->except('_token', '_method', 'password_confirmation'), $clientArray = $client->toArray());

          if($diff){
            $log = 'User Update - '. $user->name . 'successfully updated <ul>';
            foreach(array_keys($diff) as $key){
              $log .= '<li>'.$user->$key.' changes to '.$request->$key.'</li>';
            }
            $log .= '</ul>';

            $this->log([
              'user_id' => Auth::user()->id,
              'log' => $log
            ]);
          }

          $data = $request->input();
          $data['password'] = bcrypt($request->password);
          $user->update($data);
        }

        flash()->success("User successfully updated");

        return redirect(route('users.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $this->log([
          'user_id' => Auth::user()->id,
          'log' => 'Removed User - '.$user->name.' successfully deleted.'
        ]);

        $user->delete();

        flash()->success('User successfully deleted!');

        return redirect(route('users.index'));
    }
}
