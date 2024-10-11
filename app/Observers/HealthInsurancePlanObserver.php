<?php

namespace App\Observers;

use App\Models\HealthInsurancePlan;
use App\Services\ProcedurePriceServices;

class HealthInsurancePlanObserver
{

    public function created(HealthInsurancePlan $healthInsurancePlan): void
    {
        (new ProcedurePriceServices())->generateProcedurePricesAtNewHealthInsurancePlan($healthInsurancePlan);
    }

    /**
     * Handle the HealthInsurancePlan "updated" event.
     */
    public function updated(HealthInsurancePlan $healthInsurancePlan): void
    {
        //
    }

    public function deleted(HealthInsurancePlan $healthInsurancePlan): void
    {
        //
    }

    public function restored(HealthInsurancePlan $healthInsurancePlan): void
    {
        //
    }

}
