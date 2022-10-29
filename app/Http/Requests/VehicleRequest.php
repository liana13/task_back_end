<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class VehicleRequest extends FormRequest
{
    private const NOT_REQUIRED = 'nullable';
    private const REQUIRED = 'required';

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        $ruleRequried = self::REQUIRED;

        if (in_array($this->method(), ['PUT', 'PATCH'])) {
            $ruleRequried = self::NOT_REQUIRED;
        }

        return [
            'model' => [$ruleRequried, 'string', 'min:2'],
            'class' => [$ruleRequried, 'string', 'min:2'],
            'user_id' => [self::NOT_REQUIRED, Rule::exists('users', 'id')],
        ];
    }
}
