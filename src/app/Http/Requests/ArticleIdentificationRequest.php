<?php

namespace App\Http\Requests;

use App\Rules\Identification;
use Illuminate\Foundation\Http\FormRequest;

class ArticleIdentificationRequest extends FormRequest
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
            'articleToken' => [new Identification],
            'id' => ['exists:articles,id']
        ];
    }
}
