<?php

namespace App\Http\Controllers;

use App\Http\Traits\TimeSlots;
use App\Models\Appointment;
use App\Models\BusinessHour;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    use TimeSlots;
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
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $doctors = User::where('role','doctor')->get();

        $availableSlots = $this->availableSlots($doctors);
        //dd($availableSlots);

        $appointments = Appointment::paginate(5);
        return view('home',compact('appointments','availableSlots','doctors'));
    }

}
