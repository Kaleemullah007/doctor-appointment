<?php

use Carbon\Carbon;

if (! function_exists('convertDateTimeToUserTimeZone')) {
    function convertDateTimeToUserTimeZone($timezone,$datetime,$format) {
        return Carbon::parse($datetime)
            ->setTimezone($timezone)->format($format);
    }
}
if (! function_exists('convertDateTimeToUserTimeZoneUTC')) {
    function convertDateTimeToUserTimeZoneUTC($datetime,$format) {
        return Carbon::parse($datetime)
            ->setTimezone('UTC')->format($format);
    }
}
