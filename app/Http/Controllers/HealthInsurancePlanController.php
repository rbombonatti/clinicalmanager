<?php

namespace App\Http\Controllers;

use App\Http\Requests\HealthInsurancePlan\HealthInsurancePlanRequest;
use App\Models\HealthInsurancePlan;
use App\Models\Procedure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class HealthInsurancePlanController extends Controller
{
    public function index(Request $request): Response
    {
        $healthinsuranceplans = HealthInsurancePlan::withRelations()
            ->search($request->input('search'))
            ->paginate(4);

        return Inertia::render('HealthInsurancePlans/Index', [
            'healthinsuranceplans' => $healthinsuranceplans,
            'request' => $request,
            'totalProcedures' => Procedure::all()->count(),
        ]);

    }

    public function create(): Response
    {
        return Inertia::render('HealthInsurancePlans/Create');
    }

    public function store(HealthInsurancePlanRequest $request): RedirectResponse
    {
        HealthInsurancePlan::create($request->validated());
        return redirect()->route('healthinsuranceplans.index');
    }

    public function show(HealthInsurancePlan $healthinsuranceplan): Response
    {
        return Inertia::render('HealthInsurancePlans/Show', [
            'healthinsuranceplan' => $healthinsuranceplan,
        ]);
    }

    public function edit(HealthInsurancePlan $healthinsuranceplan): Response
    {
        return Inertia::render('HealthInsurancePlans/Edit', [
            'healthinsuranceplan' => $healthinsuranceplan,
        ]);
    }

    public function update(HealthInsurancePlanRequest $request, HealthInsurancePlan $healthinsuranceplan): RedirectResponse
    {
        $healthinsuranceplan->update($request->validated());
        return redirect()->route('healthinsuranceplans.index');
    }

    public function destroy(HealthInsurancePlan $healthinsuranceplan): void
    {
        $healthinsuranceplan->delete();
    }
}
