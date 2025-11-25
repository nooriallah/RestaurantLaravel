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
        // Check the user only can select date in one week not more
       $selectDate = Carbon::parse($value);
       $today = Carbon::today();

       if($selectDate->isBefore($today) || $selectDate->gt($today->addWeek())) {
            $fail("The selected date must be within one week from today");
       }




    }
}
