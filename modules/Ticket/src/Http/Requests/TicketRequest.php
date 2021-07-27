<?php

namespace Ticket\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TicketRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            "title" => ["required", "min:3", "max:190"],
            "body" => ["required"],
            "attachment" => ["nullable", "file", "mimes:avi,mkv,mp4,zip,rar", "max:102400"]
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
