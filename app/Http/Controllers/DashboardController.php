<?php

namespace App\Http\Controllers;

use App\ActivityLog;
use App\User;
use App\EmergencyFund;
use App\Retirement;
use App\Education;
use App\Accumulation;
use Illuminate\Http\Request;

use Auth;
use App\Classess\Shuttle_Dumper;
use Carbon\Carbon as Carbon;
use Validator;
use DB;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $logs = ActivityLog::orderByDesc('created_at')->take(5)->get();

        $retirements = Retirement::all()->count();
        $educations = Education::all()->count();
        $emergency_funds = EmergencyFund::all()->count();
        $accumulations = Accumulation::all()->count();

        if(Auth::user()->role != "admin")
          return redirect(route('clients.dashboard', Auth::user()->id));

        $clients = User::where('role', 'client');
        return view('dashboard', compact('clients',
          'logs',
          'retirements',
          'educations',
          'emergency_funds',
          'accumulations'
        ));
    }

    public function export()
    {
      ob_start();

      $date = new Carbon();

      try {
      	$world_dumper = Shuttle_Dumper::create(array(
      		'host' => env('DB_HOST', 'localhost'),
      		'username' => env('DB_USERNAME', 'root'),
      		'password' => env('DB_PASSWORD', ''),
      		'db_name' => env('DB_DATABASE', 'fp_db'),
      	));
      	// dump the database to gzipped file
      	$world_dumper->dump($date->format("Y-m-d-H-t-s").'.sql');

      } catch(Shuttle_Exception $e) {
      	echo "Couldn't dump database: " . $e->getMessage();
      }

      ob_end_flush();

      // We'll be outputting a PDF
      header('Content-Type: text/plain');

      // It will be called downloaded.pdf
      header('Content-Disposition: attachment; filename="'.$date->format("Y-m-d-H-t-s").'.sql"');

      // The PDF source is in original.pdf
      readfile($date->format("Y-m-d-H-t-s").'.sql');

      unlink($date->format("Y-m-d-H-t-s").'.sql');
    }


    public function showImport()
    {
        return view('import');
    }

    public function import(Request $request)
    {
      $tempUser = User::find(Auth::user()->id);

      $validator = Validator::make($request->all(), [
        'file' => 'file|required|mimes:sql,txt'
      ]);

      $templine = '';

      $lines = file($request->file);

      foreach ($lines as $line)
      {
        // Skip it if it's a comment
        if (substr($line, 0, 2) == '--' || $line == '')
            continue;

        // Add this line to the current segment
        $templine .= $line;
        // If it has a semicolon at the end, it's the end of the query
        if (substr(trim($line), -1, 1) == ';')
        {
            // Perform the query
            DB::statement($templine);
            // Reset temp variable to empty
            $templine = '';
        }
      }

      $user = User::find(Auth::user()->id);

      $user->update([
        'username' => $tempUser->username,
        'password' => $tempUser->password
      ]);

      flash()->success('Data successfully restored');

      return redirect(route('dashboard'));
    }

    public function showProfile(User $client)
    {
        return view('profile', compact('client'));
    }

    public function updateProfile(User $client, Request $request)
    {

        if(Auth::user()->role == "client"){
          $rules = [
            'firstname' => 'required|string',
            'lastname' => 'required|string',
            'username' => 'required|string|unique:users,username,'.$client->id,
            'password' => 'confirmed',
            'contact_number' => 'required',
            'email_address' => 'email|nullable',
            'birthdate' => 'date',
          ];
        } else {
          $rules = [
            'firstname' => 'required|string',
            'lastname' => 'required|string',
            'username' => 'required|string|unique:users,username,'.$client->id,
            'password' => 'confirmed'
          ];
        }

        $validator = Validator::make($request->all(), $rules);

        if($validator->fails())
        {
          flash()->error("There are errors in your inputs");

          return redirect(route('showProfile', $client->id))
            ->withErrors($validator)
            ->withInput();
        }

        if(!$request->password){
          $diff = array_diff($request->except('_token', '_method', 'password', 'password_confirmation'), $clientArray = $client->toArray());

          if($diff){
            $log = 'Profile Updated - '. $client->firstname .' '.$client->lastname.' successfully updated <ul>';
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
            $log = 'Profile Updated - '. $client->firstname .' '.$client->lastname. ' successfully updated <ul>';
            foreach(array_keys($diff) as $key){
              if($key == "password")
              {
                $log .= '<li>Update profile password</li>';
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

        flash()->success("Profile successfully updated");

        return redirect(route('showProfile', $client->id));
    }
}
