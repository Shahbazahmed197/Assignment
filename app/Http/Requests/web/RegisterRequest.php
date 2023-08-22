<?php

namespace App\Http\Requests\Web;

use App\Models\User;
use App\Rules\AgreedToPolicies;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RegisterRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required','string', 'max:255'],
            'email' => ['required','email', 'max:255', Rule::unique(User::class)],
            'password' => 'required|string|min:8|confirmed',
            'agreed_to_policies' => 'required',
        ];
    }
}
