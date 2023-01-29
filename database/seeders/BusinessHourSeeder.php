<?php

namespace Database\Seeders;

use App\Models\BusinessHour;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BusinessHourSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */

    static function run(object $user)
    {

        $days = array("Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday");
        foreach($days as $day)
        {
            BusinessHour::factory(1)->create([
                'day' => $day,
                'user_id' => $user->id
            ]);
        }
    }
}
