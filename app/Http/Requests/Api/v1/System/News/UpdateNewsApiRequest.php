<?php

namespace App\Http\Requests\Api\v1\System\News;

use Illuminate\Foundation\Http\FormRequest;

class UpdateNewsApiRequest extends FormRequest
{
    public function rules()
    {
        return [
            'title' => ['nullable', 'string'],
            'description' => ['nullable', 'max:1000'],
            'text' => ['nullable', 'max:1000'],
            'image' => ['nullable', 'image'],
        ];
    }
}
