<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
            'name'=>'required|min:3|unique:categories',
        ];
    }
        public function messages()
    {
        return [
            'name.required' => 'A Name is required must be no empaty',
            'name.unique' => 'A Name is Unique must be no repeated',
        ];
    }

        public function attributes()
    {
        return [
            'name' => 'Blog Name',
        ];
    }
}
