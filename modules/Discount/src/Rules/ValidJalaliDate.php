<?php

namespace Discount\Rules;

use Illuminate\Contracts\Validation\Rule;
use Morilog\Jalali\Jalalian;

class ValidJalaliDate implements Rule
{

    public function __construct()
    {
        //
    }

    public function passes($attribute, $value)
    {
        try {
            Jalalian::fromFormat("Y/m/d H:i", $value)->toCarbon();
            return true;
        } catch (\Exception $exception) {
            return false;
        }
    }

    public function message()
    {
        return 'تاریخ شمسی معتبر وارد کنید';
    }
}
