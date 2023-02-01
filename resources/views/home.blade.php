@extends('layouts.app')
{{-- toastr --}}
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Appointments') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div id="appointment">
                            @include('load-appointment')
                        </div>
                    </div>
                </div>
            </div>
            @if(count($availableSlots) > 0)


                <div class="col-md-4">
                    <div class="card">
                        @if($doctors->count()>0 && auth()->user()->role=='patient')
                            <label>Doctors</label>
                            <select name="doctor_id" id="doctor_id" onchange="getTimeSlotList(this.value)">

                                @foreach($doctors as $doctor)
                                    <option value="{{$doctor->id}}">{{$doctor->name}}</option>
                                @endforeach

                            </select>
                            <br>
                        @else
                            <selcet name="doctor_id" id="doctor_id"></selcet>
                        @endif


                            @if($users != null  && auth()->user()->role=='doctor')
                                <label>Users</label>
                                <select name="user_id" id="user_id" >

                                    @foreach($users as $user)
                                        <option value="{{$user->id}}">{{$user->name}}</option>
                                    @endforeach

                                </select>
                                <br>
                            @else
                                <selcet name="user_id" id="user_id"></selcet>
                            @endif

                        <div class="card-header">{{ __('Time Slots') }}</div>

                        <ul class="list-group" id="slots_time">
                          @include('time-slots')
                        </ul>

                        <div class="card-body">
                        </div>
                    </div>
                </div>
        </div>
        @endif
    </div>
@endsection
<script>


    function getAppointments(time){
        var confirmation = window.confirm("Do you want to Get Appointment");
        if(confirmation === true) {
            var doctor_id = document.getElementById("doctor_id").value;
            var user_id = document.getElementById("user_id").value;
            date = time;
            console.log(time + '--' + doctor_id)
            axios.post('{{route("appointment.store")}}', {date: date, doctor_id: doctor_id,user_id:user_id})
                .then((response) => {
                    console.log(response);
                    toastr.options.timeOut = 10000;
                    if (response.data.error == true) {
                        const element = document.getElementById("li"+time);
                        element.remove();


                        toastr.success(response.data.message).css({
                            "color":"black",
                            "background-color":'#198754',
                            "margin-top":'600px',

                        });
                        document.getElementById("appointment").innerHTML = response.data.html;

                    }else{
                        toastr.success(response.data.message).css({
                            "color":"black",
                            "background-color":'red',
                            "margin-top":'600px',

                        });
                    }

                })
                .catch(function (error) {
                    toastr.options.timeOut = 10000;
                    toastr.success('Slot time already taken from an other patient').css({
                        "color":"black",
                        "background-color":'red',
                        "margin-top":'600px',

                    });


                });
        }
    }

    function getTimeSlotList(id){

        axios.get('time-slots?id='+id)
            .then((response)=>{
                // console.log(response);
                document.getElementById("slots_time").innerHTML = response.data.html;
            })
    }

</script>
