<?php

namespace App\Http\Controllers\Api;

use App\Http\Services\ConsultationService;
use App\Models\Consultation;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class ConsultationApiController
{
    private ConsultationService $consultationService;
    public function __construct(ConsultationService $consultationService)
    {
        $this->consultationService = $consultationService;
    }

    public function update(Request $request): JsonResponse
    {
        try {
            $consultation = Consultation::findOrFail($request->id);
            $data = $request->all();
            $data['reference_price'] = $this->consultationService->getRefPrice($request);
            $consultation->update($data);
            return response()->json([
                'message' => 'Consulta atualizada com sucesso',
                'data' => $consultation
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Erro ao atualizar consulta!',
                'data' => $th
            ], 400);
        }

    }

    public function consultationsApi(): JsonResponse
    {
        $consultations = Consultation::withRelations()->orderBy('id', 'ASC')->get();
        return response()->json($consultations);
    }

    public function create(Request $request): JsonResponse
    {
        $data = $request->all();
        $data['user_id'] = $request->user()->id;
        $data['reference_price'] = $this->consultationService->getRefPrice($request);
        $consultation = new Consultation();
        $consultation = $consultation->create($data);
        return response()->json([
            'message' => 'Consulta inserida com sucesso',
            'data' => $consultation
        ], 200);
    }

}
