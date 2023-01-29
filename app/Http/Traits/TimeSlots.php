<?php
namespace App\Http\Traits;
use App\Models\Appointment;
use App\Models\BusinessHour;
use Carbon\Carbon;

trait  TimeSlots{

    public function availableSlots($doctors){
        $currentDay = date('l');
        $curentDate = date('Y-m-d');
        $availableTimeSlots = array();

        $doctor_id = null;
        if(auth()->user()->role == 'doctor') {
            $doctor_id = auth()->id();
        }
        else {
            $doctor_id = $doctors->first()->id;
        }

        $allTimeSlots = BusinessHour::
        where(array('user_id' =>$doctor_id, 'day' => $currentDay))
            ->limit(1)
            ->first();

        if($allTimeSlots != null){
            $allTimeSlots = $allTimeSlots->time_slots;
        }
        else{
            $allTimeSlots = array();
        }
        $booked_appointments = Appointment::withoutGlobalScopes()
            ->with('userDetalil')
            ->whereDate('date', $curentDate)
            ->where('doctor_id' , $doctor_id)->get()->map(function($row){
                return Carbon::parse($row->time)->setTimezone($row->userDetalil->timezone)
                    ->format('H:i');
            })->toArray();

            $availableTimeSlots = array_diff($allTimeSlots, $booked_appointments);
            // dd($availableTimeSlots,$allTimeSlots, $booked_appointments);

        return $availableTimeSlots;
}

}
