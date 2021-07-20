<?php


namespace Course\Http\Requests;


use Course\Models\Course;
use Course\Rules\ValidSeason;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Course\Rules\ValidTeacher;

class LessonCreateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title' => ['required', 'min:3', 'max:190'],
            'slug' => ['nullable','min:0', 'max:190'],
            'position' => ['nullable','numeric'],
            'time' => ['required','numeric'],
            'free' => ['required','boolean'],
            'season_id' => ['nullable', new ValidSeason()],
            'body' => ['nullable'],
            'attachment' => ['required'],
        ];
    }

    public function attributes()
    {
        return [
          'position' => 'شماره سر فصل',
          'attachment' => 'فایل درس'
        ];
    }

    public function messages()
    {
        return [
            'price' => 'قیمت'
        ];
    }
}
