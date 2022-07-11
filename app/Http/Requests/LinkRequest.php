<?php

namespace App\Http\Requests;

use App\Models\Tag;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class LinkRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'domain_id' => [
                'required',
                'numeric',
                Rule::exists('domains', 'id'),
            ],
            'url' => [
                'required',
                'url',
                'max:255',
            ],
            'title' => [
                'nullable',
                'string',
                'max:255',
            ],
            'password' => [
                'nullable',
                'string',
                'max:255',
            ],
            'description' => [
                'nullable',
                'string',
                'max:2048',
            ],
            'expires_at' => [
                'nullable',
                'date',
            ],
        ];
    }

    /**
     * @return \Illuminate\Support\Collection 
     */
    public function getTags()
    {
        return collect($this->get('tags'))
            ->map(function ($tag) {
                return new Tag($tag);
            })
            ->map(function ($tag) {
                return $tag->id ?? Tag::firstOrCreate(['value' => $tag->value])->id;
            });
    }
}
