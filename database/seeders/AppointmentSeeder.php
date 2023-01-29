<?php

namespace Database\Seeders;

use App\Models\Appointment;
use App\Models\BusinessHour;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AppointmentSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    static function run(object $user)
    {

        $created_user = $user->id;
        $doctor_id = User::inRandomOrder()

            ->Where('role','doctor')->value('id');
        $currentDay = date('l');
        $curentDate = date('Y-m-d');
        $allTimeSlots = BusinessHour::
            where(array('user_id'=>$doctor_id,'day'=>$currentDay))
            ->limit(1)
            ->first();
        if($allTimeSlots != null){
            $allTimeSlots->user = $user;
            $allTimeSlots = $allTimeSlots->time_slots;
        }
        else{
            $allTimeSlots = array();
        }


        $booked_appointments = Appointment::where('date', $curentDate)
            ->where('doctor_id' , $doctor_id)
            ->pluck('time')->toArray();
        $availableSlots = array_diff($allTimeSlots, $booked_appointments);
        $count = count($availableSlots);
        if($count > 0) {
            $rand = random_int(0, $count - 1);
            Appointment::factory(1)->create([
                'user_id' => $created_user,
                'doctor_id'=>$doctor_id,
                'time' => $availableSlots[$rand]]
            );
        }

    }
}
