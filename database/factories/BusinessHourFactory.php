<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BusinessHour>
 */
class BusinessHourFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'is_day'=>1,
            'step'=>30,
            'from'=>'9:00:00',
            'to'=>'15:00:00'
        ];
    }
}
