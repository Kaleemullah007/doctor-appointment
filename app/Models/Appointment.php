<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Traits\FilterByUser;
class Appointment extends Model
{
    use HasFactory;
    use FilterByUser;

    protected $appends = ['time'];

    protected $fillable = ['name','date','time','user_id','doctor_id'];

    public function getTimeAttribute($value){

        return Carbon::parse($value)
            ->format('H:i');
    }
    public function userDetalil(){
        return $this->belongsTo('App\Models\User','user_id','id');
    }


}
