<?php

namespace App\Http\Controllers\Api;

use App\Models\Doctor;
use Illuminate\Http\JsonResponse;

class DoctorApiController
{
    public function doctorsApi(): JsonResponse
    {
        $doctors = Doctor::withRelations()->get();
        return response()->json($doctors);
    }
}
