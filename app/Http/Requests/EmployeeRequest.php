<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'employeeId'    =>  'required|string|max:255',
            'fname'         =>  'required|string|max:255',
            'mname'         =>  'string|max:255',
            'lname'         =>  'required|string|max:255',
            'email'         =>  'required|string|email',
            'designation'   =>  'required|string|max:255',
            'department'    =>  'required|string|max:255',
            'empType'       =>  'required|string|max:255',
            'workPlace'     =>  'required|string|max:255',
            'empStatus'     =>  'required|string|max:255',
            'avatar'        =>  'image',
        ];
    }
}
