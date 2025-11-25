<?php

namespace App\Rules;

use Carbon\Carbon;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class TimeBetween implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // Check the user only can select date in one week not more
        $selectDate = Carbon::parse($value);
        $today = Carbon::today();
        
        if ($selectDate->isBefore($today) || $selectDate->gt($today->addWeek())) {
            $fail("The selected date must be within one week from today");
        }

        // Check that user only can select time from 7am to 10pm
        $time = Carbon::createFromTimeString($value);
        $openingTime = Carbon::createFromTime(7, 0, 0);
        $closingTime = Carbon::createFromTime(22, 0, 0);

        if ($time->lt($openingTime) || $time->gt($closingTime)) {
            $fail('The selected time must be between 7:00 AM and 10:00 PM.');
        }

    }
}
