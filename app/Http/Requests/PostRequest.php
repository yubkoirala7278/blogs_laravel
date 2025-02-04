<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
            'title'=>['required','string','max:255'],
            'description'=>['required','string'],
            'status'=>['required','integer','max:255'],
            'category'=>['required','integer','max:255'],
            'image' =>$this->isMethod('POST') ? 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048' : 'nullable|sometimes',
            'tags'=>['required','array'],
            'tags.*'=>['required','string','max:255'],
        ];
    }
}
