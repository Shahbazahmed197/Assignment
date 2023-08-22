<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Validation\Rule;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\Rules\Password;
class UpdatePasswordRequest extends FormRequest
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
        return auth('sanctum')->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'current_password' => 'required',
            'password' => ['required', 'confirmed', Password::defaults(),'different:current_password'],
        ];
    }
}
