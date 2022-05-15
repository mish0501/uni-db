<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEmployeeRequest extends FormRequest
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
        $userId = $this->route('employee')->user->id;

        return [
            'email' => 'required|string|email|max:255|unique:users,email,' . $userId,
            'phone' => 'required|string|max:255',
            'password' => 'sometimes|string|min:6|confirmed',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'pid' => 'required|digits:10',
            'position' => 'required|exists:positions,id',
        ];
    }
}
