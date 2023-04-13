<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Crypt;

class FormRequestSubmit extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return  [
            'name' => 'required|unique:categories',
            'slug' => 'required|unique:categories',
            'alt' => 'required',
            'image' => 'required|mimes:jpg,png,jpeg,webp|max:2048',
            'description' => 'required',
            'meta_title' => 'required|max:160',
            'meta_keyword' => 'required|max:200',
            'meta_description' => 'required',
        ];
    }
}
