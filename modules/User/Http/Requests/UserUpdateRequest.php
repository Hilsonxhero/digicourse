<?php

namespace User\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use User\Models\User;
use User\Rules\ValidMobile;
use Illuminate\Validation\Rules;

class UserUpdateRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'id' => ['required'],
            'name' => ['required', 'min:3'],
            'roles' => ['required', 'min:1', 'exists:roles,name'],
            'email' => ['required', 'min:3', Rule::unique('users', 'email')->ignore(request()->id)],
            'phone' => ['nullable',new ValidMobile(),Rule::unique('users', 'phone')->ignore(request()->id)],
            'password' => ['nullable', 'confirmed', Rules\Password::defaults()],
            'status' => ['required', Rule::in(User::$statuses)],
            'thumb' => ['nullable']
        ];
    }
}
