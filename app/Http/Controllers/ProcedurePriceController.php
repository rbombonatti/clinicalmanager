<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProcedurePrice\StoreProcedurePriceRequest;
use App\Http\Requests\ProcedurePrice\UpdateProcedurePriceRequest;
use App\Http\Services\ProcedureService;
use App\Models\HealthInsurancePlan;
use App\Models\PriceList;
use App\Models\ProcedurePrice;
use App\Services\ProcedurePriceServices;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class ProcedurePriceController extends Controller
{
    private ProcedurePriceServices $procedurePriceServices;
    private mixed $procedures;
    public function __construct()
    {
        $this->procedurePriceServices = new ProcedurePriceServices();
        $this->procedures = (new ProcedureService())->getAllProcedures();
    }

    public function index(Request $request): Response
    {
        $procedureprices = ProcedurePrice::withRelations()
            ->search($request->input('search'))
            ->paginate(4);

        return Inertia::render('ProcedurePrices/Index', [
            'procedureprices' => $procedureprices,
            'request' => $request,
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('ProcedurePrices/Create', [
            'healthinsuranceplans' => HealthInsurancePlan::all(),
            'procedures' => $this->procedures,
            'pricelists' => PriceList::active()->get(),
        ]);
    }

    public function store(StoreProcedurePriceRequest $request): RedirectResponse
    {
        ProcedurePrice::create([
                'procedure_id' => $request->procedure_id,
                'health_insurance_plan_id' => $request->health_insurance_plan_id,
                'price_list_id' => $request->price_list_id,
                'price' => real_to_float($request->price)
            ]);
        return redirect()->route('procedureprices.index');
    }

    public function show(ProcedurePrice $procedureprice): Response
    {
        $procedureprice = $procedureprice->load('procedure', 'healthInsurancePlan', 'priceList');
        return Inertia::render('ProcedurePrices/Show', [
            'procedureprice' => $procedureprice
        ]);
    }

    public function edit(ProcedurePrice $procedureprice): Response
    {
        return Inertia::render('ProcedurePrices/Edit', [
            'procedureprice' => $procedureprice,
            'healthinsuranceplans' => HealthInsurancePlan::all(),
            'procedures' => $this->procedures,
            'pricelists' => PriceList::active()->get(),
        ]);
    }

    public function update(UpdateProcedurePriceRequest $request, ProcedurePrice $procedureprice): RedirectResponse
    {
        $procedureprice->update([
            'price' => real_to_float($request->price)
        ]);

        return redirect()->route('procedureprices.index');

    }

    public function destroy(ProcedurePrice $procedureprice): void
    {
        $procedureprice->delete();
    }

    public function generateProcedurePricesAtNewHealthInsurancePlan(HealthInsurancePlan $healthinsuranceplan): void
    {
        $this->procedurePriceServices->generateProcedurePricesAtNewHealthInsurancePlan($healthinsuranceplan);
    }
}
