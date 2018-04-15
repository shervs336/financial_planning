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
        dd(EmergencyFund::all());
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
}
