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
}
