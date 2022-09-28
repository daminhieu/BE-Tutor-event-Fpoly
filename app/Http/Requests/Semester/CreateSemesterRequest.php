<?php

namespace App\Http\Requests\Semester;

use Illuminate\Foundation\Http\FormRequest;

class CreateSemesterRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|min:5|max:100|string|unique:semesters',
            'start_time' => 'date|before:end_time',
            'end_time' => 'date'
        ];
    }
}
