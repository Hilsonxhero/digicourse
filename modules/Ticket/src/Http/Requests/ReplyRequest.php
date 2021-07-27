<?php

namespace Ticket\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReplyRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            "body" => ["required"],
            "attachment" => ["nullable", "mimes:avi,mkv,mp4,zip,rar,jpg,png,jpeg", "max:102400"]
        ];
    }

    public function attributes()
    {
        return [
            "title" => "عنوان تیکت",
            "body" => "متن تیکت",
            "attachment" => "فایل ضمیمه تیکت"
        ];
    }
}
