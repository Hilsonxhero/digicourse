<?php


namespace Course\Http\Requests;


use Course\Models\Course;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Course\Rules\ValidTeacher;

class CourseCreateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title' => ['required','min:3','max:190'],
            'slug' => ['required','min:3','max:190','unique:courses,slug'],
            'price' => ['required','numeric'],
            'percent' => ['required','numeric'],
            'position' => ['required','numeric'],
            'teacher_id' => ['required','exists:users,id',new ValidTeacher()],
            'tags' => ['nullable'],
            'type' => ['required',Rule::in(Course::$types)],
            'status' => ['required',Rule::in(Course::$statuses)],
            'category_id' => ['required','exists:categories,id'],
            'banner' => ['nullable'],
            'body' => ['nullable']
        ];
    }

    public function messages()
    {
       return [
         'price' => 'قیمت'
       ];
    }
}
