<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EditUserRequest extends FormRequest
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
        $userId = $this->input('id'); // Retrieve user ID from the form input
        return [
            'name'=>"required",
            'email' => ['required', 'email', Rule::unique('users', 'email')->ignore($userId)],
            'country_id'=>"required",
            'rol'=>"required",
        ];
    }
}
