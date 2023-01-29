<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreAppointmentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {

        $date = $this->date;
        $time = $this->time;
        $user_id = $this->user_id;
        $doctor_id = $this->doctor_id;
        return [
            'time'=>'required',
            'user_id'=>'required',
            'name'=>'required',
            'doctor_id'=>'required',
            'date'=>['required',
                Rule::unique('appointments')->where(function ($query) use($date,$time,$user_id,$doctor_id) {
                    return $query->whereDate('date', $date)
                        ->where('time', $time)
                    ->where('doctor_id', $doctor_id);
                })]
        ];
    }

    protected function prepareForValidation()
    {
        if(auth()->user()->role == 'doctor'){
            $doctor_id = auth()->user()->id;
        }
        else{
            $doctor_id = $this->doctor_id;
        }

        $covnertedTime = Carbon::parse($this->date)
            ->setTimezone('UTC')->format('H:i:s');
        $this->merge([
            'user_id'=>auth()->id(),
            'name'=>auth()->user()->name,
            'doctor_id'=>$doctor_id,
            'date'=>date('Y-m-d'),
            'time'=>$covnertedTime

        ]);
    }

}
