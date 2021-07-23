<?php

namespace Payment\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Payment\Models\Settlement;

class SettlementRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {

        if (request()->getMethod() === "PUT") {
            return [
                "from.name" => "required_if:status," . Settlement::STATUS_SETTLED,
                "from.cart" => "required_if:status," . Settlement::STATUS_SETTLED,
                "to.name" => "required_if:status," . Settlement::STATUS_SETTLED,
                "to.cart" => "required_if:status," . Settlement::STATUS_SETTLED,
                "amount" => "required|numeric|min:10000",
            ];
        }
        return [
            "name" => ["required"],
            "cart_number" => ["required", "numeric"],
            "amount" => "required|min:10000|numeric|max:" . auth()->user()->balance
        ];


    }

    public function attributes()
    {
        return [
            'amount' => 'مقدار تسویه',
            'cart_number' => 'شماره کارت',
            'settled' => 'تسویه شده',
            'from.name' => 'نام فرستنده',
            'from.cart' => 'شماره کارت  فرستنده',
        ];
    }
}
