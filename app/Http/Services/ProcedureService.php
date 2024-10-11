<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class ProcedureService
{
    public function getAllProcedures()
    {
        return Cache::remember('procedures', 3600, function () {
            return DB::table('procedures')->get();
        });
    }

    public function getProcedureIdTitle()
    {
        return self::getAllProcedures()->map(function ($procedure) {
            return [
                'id' => $procedure->id,
                'title' => $procedure->title,
            ];
        });
    }
}
