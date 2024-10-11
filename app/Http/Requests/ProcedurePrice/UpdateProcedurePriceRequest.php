<?php

namespace App\Http\Requests\ProcedurePrice;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProcedurePriceRequest extends FormRequest
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
            'procedure_id' => 'required|int|exists:procedures,id',
            'health_insurance_plan_id' => 'required|int|exists:health_insurance_plans,id',
            'price_list_id' => 'required|int|exists:price_lists,id',
            'price' => 'required'
        ];
    }
}
