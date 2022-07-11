<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProfileRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignoreModel($this->user()),
            ],
            'password' => [
                'nullable',
                'confirmed',
                'string',
                'min:6',
            ],
            'image' => [
                'nullable',
                'string',
                'max:255',
            ]
        ];
    }
}
