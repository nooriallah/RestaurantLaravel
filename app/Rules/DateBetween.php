<?php

namespace App\Rules;

use Carbon\Carbon;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use function Symfony\Component\Clock\now;

class DateBetween implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
       
       // Normalize to DATE ONLY
        $selectedDate = Carbon::parse($value)->startOfDay();
        $today = Carbon::today();
        $maxDate = Carbon::today()->addWeek()->startOfDay();

        if ($selectedDate->lt($today) || $selectedDate->gt($maxDate)) {
            $fail("The selected date must be within one week from today.");
        } 
    }
}
