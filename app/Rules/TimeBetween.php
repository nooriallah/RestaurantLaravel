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
        

        // If NO time part exists (user submitted only a date), skip time validation.
        // if (strlen($value) <= 10) { // format "YYYY-MM-DD"
        //     return;
        // }

        // Validate time
        $selectedTime = Carbon::parse($value);
        $timeOnly = $selectedTime->format('H:i');
        $time = Carbon::createFromFormat('H:i', $timeOnly);

        $opening = Carbon::createFromTime(7, 0);
        $closing = Carbon::createFromTime(22, 0);

        if ($time->lt($opening) || $time->gt($closing)) {
            $fail("The selected time must be between 7:00 AM and 10:00 PM.");
        }
    }
}
