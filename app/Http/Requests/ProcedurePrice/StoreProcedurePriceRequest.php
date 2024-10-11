<?php

namespace App\Http\Requests\ProcedurePrice;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreProcedurePriceRequest extends FormRequest
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
            'procedure_id' => 'int|exists:procedures,id',
            'health_insurance_plan_id' => 'int|exists:health_insurance_plans,id',
            'price' => 'required',
            'price_list_id' => [
                'required',
                'exists:price_lists,id',
                Rule::unique('procedure_prices')->where(function ($query) {
                return $query->where('procedure_id', $this->procedure_id)
                    ->where('health_insurance_plan_id', $this->health_insurance_plan_id)
                    ->where('price_list_id', $this->price_list_id)
                    ->where('deleted_at', null);
                })
            ]
        ];
    }
}
