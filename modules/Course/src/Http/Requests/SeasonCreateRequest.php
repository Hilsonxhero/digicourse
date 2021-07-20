<?php


namespace Course\Http\Requests;


use Course\Models\Course;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Course\Rules\ValidTeacher;

class SeasonCreateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title' => ['required', 'min:3', 'max:190'],
            'position' => ['nullable', 'numeric', 'min:0', 'max:190'],
        ];
    }

    public function attributes()
    {
        return [
          'position' => 'شماره سر فصل'
        ];
    }

    public function messages()
    {
        return [
            'price' => 'قیمت'
        ];
    }
}
