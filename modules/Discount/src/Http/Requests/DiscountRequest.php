<?php

namespace Discount\Http\Requests;

use Discount\Rules\ValidJalaliDate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DiscountRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        if (request()->getMethod() == "PUT"){
            return  [
                "code" => ["nullable", Rule::unique("discounts","code")->ignore(request()->id)],
            ];
        }
        return [
            "code" => ["nullable", "max:50","unique:discounts,code"],
            "percent" => ["required", "numeric", "min:1", "max:100"],
            "usage_limitation" => ["nullable", "numeric"],
            "expire_at" => ["nullable", new ValidJalaliDate()],
            "courses" => ["nullable", "array"],
        ];

    }
}
