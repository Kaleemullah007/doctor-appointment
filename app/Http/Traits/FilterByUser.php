<?php
namespace App\Http\Traits;
use App\Models\Appointment;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

trait FilterByUser{


    public  static function boot(){
       parent::boot();


        self::addGlobalScope(function(Builder $builder){

            $role = 'patient';
            if(isset(auth()->user()->role)){
                $role = auth()->user()->role;
            }

            if ($role == 'doctor') {
                $builder->
                join('users','appointments.user_id','=','users.id')
                ->where('doctor_id', auth()->id());
            }
            else if ($role == 'patient'){
                $builder
                     ->join('users','appointments.doctor_id','=','users.id')
                     ->where('user_id', auth()->id());
            }
            else if ($role == 'admin'){
                // It'll show all record
            }
        });
    }

}
