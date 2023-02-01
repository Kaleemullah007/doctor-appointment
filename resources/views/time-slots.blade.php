@if(count($availableSlots) > 0)
@foreach($availableSlots as $time)
    <li  class="list-group-item text-center" id="li{{ convertDateTimeToUserWithoutTimeZone(auth()->user()->timezone,$time,'h:i A') }}">{{ convertDateTimeToUserWithoutTimeZone(auth()->user()->timezone,$time,'h:i A') }} <button type="button" class="btn btn-sm bg-info ms-5" id="{{ convertDateTimeToUserWithoutTimeZone(auth()->user()->timezone,$time,'h:i A') }}" onclick="getAppointments(this.id)">Make An Appointment</button> </li>

@endforeach
@else
    <li class="list-group-item text-center">No Slots availalble</li>
@endif
