<?php

namespace App\Http\Requests\Consultation;

use Illuminate\Foundation\Http\FormRequest;

class StoreConsultationRequest extends FormRequest
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
            'patient_name' => 'string|required',
            'consultation_number' => 'integer|required|unique:consultations,consultation_number',
            'consultation_date' => 'date|required',
            'paid_price' => 'float|nullable',
            'referente_price' => 'float|required',
            'procedure_id' => 'integer|required|exists:procedures,id',
            'health_insurance_plan_id' => 'integer|required|exists:healthinsuranceplans,id',
            'doctor_id' => 'integer|required|exists:doctors,id',
            'user_id' => 'integer|required|exists:users,id',
            'observations' => 'string|nullable',
        ];
    }
}
