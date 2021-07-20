<?php

namespace Course\Rules;

use Course\Repositories\SeasonRepo;
use Illuminate\Contracts\Validation\Rule;
use User\Repositories\UserRepo;

class ValidSeason implements Rule
{

    public function __construct()
    {
        //
    }

    public function passes($attribute, $value)
    {
        $season = resolve(SeasonRepo::class)->findByIdandCourseId($value, request()->route('course'));
        if ($season) {
            return true;
        }
        return false;
    }

    public function message()
    {
        return 'سرفصل انتخاب شده نامعتر است.';
    }
}
