<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $timezones = array(
            'Europe/London',
            'Asia/Karachi',
            'Asia/Karachi',
            'Europe/London'
        );
        $doc_patient = array(
            'doctor',
            'doctor',
            'patient',
            'patient',
        );

        for ($i=0; $i<4; $i++) {
            $user = User::factory(1)->create([
                'role' => $doc_patient[$i],
                'timezone' =>$timezones[$i]
            ]);
            $this->users_id = $user[0];
            if ($doc_patient[$i] == 'patient') {

               $this->callWith(AppointmentSeeder::class, ['user' => $this->users_id]);
            } else {

                $this->callWith(BusinessHourSeeder::class, ['user' => $this->users_id]);
            }
        }

        }
}
