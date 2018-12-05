<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Route;
use Illuminate\Foundation\Http\FormRequest;

class EditUserRequest extends FormRequest
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
        return [
            'email' => Rule::unique('users')->where(function ($query) {
                return $query->where('email', $this->all()['email'])->where('id','!=',Route::current()->parameters('id')['user']);
            })
        ];
    }

    public function messages()
    {
        return [
            'email.unique' => 'Email is unique!'
        ];
    }
}
