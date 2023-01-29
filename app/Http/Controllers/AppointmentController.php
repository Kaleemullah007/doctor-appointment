<?php

namespace App\Http\Controllers;

use App\Http\Traits\TimeSlots;
use App\Models\Appointment;
use App\Http\Requests\StoreAppointmentRequest;
use App\Http\Requests\UpdateAppointmentRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class AppointmentController extends Controller
{
    use TimeSlots;
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
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreAppointmentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAppointmentRequest $request)
    {

        try {



               $appointment =  Appointment::create($request->validated());
                $appointments = Appointment::paginate(5);
                $html =  view('load-appointment',compact('appointments'))->render();
                return response()->json(array('error'=>true,'message'=>'Successfully done appointment and Appointment id is '.$appointment->id,'appointment_id'=>$appointment->id,'html'=>$html));

        }
        catch (\Exception $e){
            return response()->json(array('error'=>false,'message'=>'Slot time already taken from an other patient'));
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function show(Appointment $appointment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function edit(Appointment $appointment)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAppointmentRequest  $request
     * @param  \App\Models\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAppointmentRequest $request, Appointment $appointment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Appointment $appointment)
    {
        //
    }

    public function time_slots(Request $request){
        $doctor_id = $request->id;
        $doctors = User::where('id',$doctor_id)->get();
        $availableSlots = $this->availableSlots($doctors);
//        dd($availableSlots);
        $html = view('time-slots',compact('availableSlots'))->render();
        return response()->json(['html'=>$html]);
    }
}
