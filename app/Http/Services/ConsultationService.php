<?php

namespace App\Http\Services;

use App\Enums\PriceListEnum;
use App\Models\ProcedurePrice;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\Cast\Bool_;

class ConsultationService
{
    public function getRefPrice($request)
    {
        $procedurePrice = ProcedurePrice::where('procedure_id', '=', $request->procedure_id)
            ->where('health_insurance_plan_id', '=', $request->health_insurance_plan_id)
            ->where('price_list_id', '=', PriceListEnum::ACTIVE)
            ->where('deleted_at', '=', null)
            ->first();
        return is_null($procedurePrice) ? 0 : $procedurePrice->price;
    }

    public function validateInsert(Request $request): bool
    {
        return
            $request['consultation_date'] != '' &&
            $request['patient_name'] != '' &&
            $request['consultation_number'] != '' &&
            $request['doctor_id'] != '' &&
            $request['procedure_id'] != '' &&
            $request['health_insurance_plan_id'] != '';
    }
}

