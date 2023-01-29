<?php

namespace App\Models;

use Carbon\Carbon;
use Carbon\CarbonInterval;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessHour extends Model
{
    use HasFactory;

    public function getTimeSlotsAttribute()
    {

        $timezone = '';
        if($this->user != null)
        {
            $timezone = $this->user->timezone;
        }
        else{
            $timezone = auth()->user()->timezone;
        }
        $from = convertDateTimeToUserTimeZone($timezone,$this->from,'H:i:s');
        $to = convertDateTimeToUserTimeZone($timezone,$this->to,'H:i:s');
        $times = CarbonInterval::minutes($this->step)->toPeriod($from,$to)->toArray();
        return array_map(fn($time)=>
        $time->format('H:i'),$times);

    }
}
