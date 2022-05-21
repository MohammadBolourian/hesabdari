<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TestRequest extends FormRequest
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
                'name' => 'required',
                'email' => ['required','string','email', Rule::unique('users')->ignore($this->user->id)],
                'password' => 'required|min:8',
                'pic' => 'nullable|image|mimes:png,jpg,jpeg,gif|max:3000',
        ];
    }
}
