<?php

namespace Database\Seeders;

use App\Models\BusinessHour;
use Carbon\Carbon;
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
        $covnertedTimeFrom = Carbon::parse('9:00:00',$user->timezone)
            ->setTimezone('UTC')->format('H:i:s');
        $covnertedTimeTo = Carbon::parse('15:00:00',$user->timezone)
            ->setTimezone('UTC')->format('H:i:s');
        foreach($days as $day)
        {
            BusinessHour::factory(1)->create([
                'day' => $day,
                'user_id' => $user->id,
                'from'=>$covnertedTimeFrom,
                'to'=>$covnertedTimeTo
            ]);
        }
    }
}
