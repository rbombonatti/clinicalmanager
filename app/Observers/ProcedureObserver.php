<?php

namespace App\Observers;

use App\Models\HealthInsurancePlan;
use App\Models\PriceList;
use App\Models\Procedure;
use App\Models\ProcedurePrice;
use App\Services\ProcedurePriceServices;

class ProcedureObserver
{
    /**
     * Handle the Procedure "created" event.
     */
    public function created(Procedure $procedure): void
    {
        (new ProcedurePriceServices())->generateProcedurePricesAtNewProcedure($procedure);
    }

    /**
     * Handle the Procedure "updated" event.
     */
    public function updated(Procedure $procedure): void
    {
        //
    }

    /**
     * Handle the Procedure "deleted" event.
     */
    public function deleted(Procedure $procedure): void
    {
        //
    }

    /**
     * Handle the Procedure "restored" event.
     */
    public function restored(Procedure $procedure): void
    {
        //
    }

    /**
     * Handle the Procedure "force deleted" event.
     */
    public function forceDeleted(Procedure $procedure): void
    {
        //
    }
}
