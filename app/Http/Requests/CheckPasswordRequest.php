<?php

namespace App\Http\Requests;

use App\Models\Link;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;

class CheckPasswordRequest extends FormRequest
{
    private $link;

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'password' => [
                'required',
                'string',
                'max:255',
                function ($attribute, $value, $fail) {
                    if (!Hash::check($value, optional($this->getLink())->password)) {
                        $fail('You entered incorrect password');
                    }
                },
                function ($attribute, $value, $fail) {
                    if ($this->getLink()->is_expired) {
                        $fail('The link has been expired');
                    }
                },
            ],
        ];
    }

    public function getLink(): ?Link
    {
        return $this->link ?? Link::getByHash($this->hash);
    }
}
