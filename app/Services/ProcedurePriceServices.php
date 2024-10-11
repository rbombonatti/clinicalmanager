<?php
declare(strict_types=1);

namespace App\Services;

use App\Models\HealthInsurancePlan;
use App\Models\PriceList;
use App\Models\Procedure;
use App\Models\ProcedurePrice;

class ProcedurePriceServices
{

    public function generateProcedurePricesAtNewHealthInsurancePlan(HealthInsurancePlan $healthinsuranceplan): int
    {
        $procedurePricesAlreadyCreated = $healthinsuranceplan->procedurePrices()->pluck('procedure_id')->toArray();
        $procedures = Procedure::all();
        $priceList = PriceList::where('active', true)->first();
        $newProcedures = [];
        foreach ($procedures as $procedure) {
            if (in_array($procedure->id, $procedurePricesAlreadyCreated)) continue;
            $newProcedures[] = [
                'procedure_id' => $procedure->id,
                'health_insurance_plan_id' => $healthinsuranceplan->id,
                'price_list_id' => $priceList->id,
                'price' => rand(1000, 30000)/100,
                'created_at' => now()
            ];
        }
        if (!empty($newProcedures)) {
            ProcedurePrice::insert($newProcedures);
        }

        return count($newProcedures);
    }

    public function generateProcedurePricesAtNewProcedure(Procedure $procedure): int
    {
        $priceList = PriceList::query()->where('active', true)->first();
        $healthinsuranceplans = HealthInsurancePlan::all();
        $procedures = [];
        foreach ($healthinsuranceplans as $healthinsuranceplan) {
            $procedures[] = [
                'procedure_id' => $procedure->id,
                'health_insurance_plan_id' => $healthinsuranceplan->id,
                'price_list_id' => $priceList->id,
                'price' => rand(1000, 30000)/100,
                'created_at' => now()
            ];
        }
        ProcedurePrice::insert($procedures);
        return count($procedures);
    }
}
