<?php

namespace App\Http\Controllers;

use App\Enums\ConsultationSourceEnum;
use App\Enums\ConsultationTypeEnum;
use App\Http\Requests\Consultation\StoreConsultationRequest;
use App\Http\Requests\Consultation\UpdateConsultationRequest;
use App\Http\Services\ProcedureService;
use App\Models\Consultation;
use App\Models\Doctor;
use App\Models\HealthInsurancePlan;
use App\Models\Procedure;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class ConsultationController extends Controller
{

    protected ProcedureService $procedureService;
    protected mixed $procedures;
    public function __construct(ProcedureService $procedureService)
    {
        $this->procedures = $procedureService->getProcedureIdTitle();
    }

    public function index(Request $request): Response
    {
        $doctors = Doctor::all(['id', 'first_name']);
        return Inertia::render('Consultations/Index', [
            'doctors' => $doctors,
            'procedures' => $this->procedures,
            'health_insurance_plans' => HealthInsurancePlan::all(['id', 'title']),
            'consultation_types' => ConsultationTypeEnum::all(),
            'consultation_sources' => array_merge(ConsultationSourceEnum::all(), array_column($doctors->toArray(), 'first_name')),
            'token' => $request->user()->createToken('api-token')->plainTextToken,
        ]);
    }
    public function create()
    {
        //
    }

    public function store(StoreConsultationRequest $request)
    {
        //
    }

    public function show(Consultation $consultation)
    {
        //
    }

    public function edit(Consultation $consultation)
    {
        //
    }

    public function update(UpdateConsultationRequest $request, Consultation $consultation)
    {
        $consultation->update($request->all());
        return response()->noContent();

    }

    public function destroy(Consultation $consultation)
    {
        //
    }
}
