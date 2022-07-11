<?php

namespace App\Http\Requests\Permission\Role;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Permission\Role;
use Illuminate\Validation\Rule;

class CreateRoleRequest extends FormRequest
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
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique(Role::getModel()->getTable(), 'name'),
            ],
        ];
    }
}
