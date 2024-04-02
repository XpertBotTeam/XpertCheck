<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
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
        $user_id=$this->route('user')? $this->route('user'):null;
        return [
            'name' => 'required|string',
            'email' => ['required',
        Rule::unique('users')->ignore($user_id)],
            'password' => 'required|string|min:8',
        ];
    }
}
