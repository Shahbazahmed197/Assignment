<?php

namespace App\Http\Requests\Auth;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;

class RegisterRequest extends FormRequest
{
    protected function failedValidation(Validator $validator)
    {
        throw new ValidationException($validator, $this->jsonResponse($validator));
    }

    protected function jsonResponse($validator)
    {
        return response()->json([
            'message' => $validator->errors()->first(),
            'success' => false,
            'data' => (object)[],
        ], JsonResponse::HTTP_OK);
    }
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
            'name' => ['string', 'max:255'],
            'email' => ['email', 'max:255', Rule::unique(User::class)],
            'password' => 'required|string|min:8|confirmed',
        ];
    }
}
