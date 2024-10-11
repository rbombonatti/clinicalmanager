<?php

namespace App\Http\Controllers;

use App\Http\Requests\Procedure\ProcedureRequest;
use App\Models\Procedure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Inertia\Inertia;
use Inertia\Response;

class ProcedureController extends Controller
{
    public function index(Request $request): Response
    {
        $procedures = Procedure::search($request->input('search'))->paginate(4);
        return Inertia::render('Procedures/Index', [
            'procedures' => $procedures,
            'request' => $request
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('Procedures/Create');
    }

    public function store(ProcedureRequest $request): RedirectResponse
    {
        Procedure::create($request->validated());
        Cache::flush();
        return redirect()->route('procedures.index');
    }
    public function show(Procedure $procedure): Response
    {
        return Inertia::render('Procedures/Show', [
            'procedure' => $procedure
        ]);
    }

    public function edit(Procedure $procedure): Response
    {
        return Inertia::render('Procedures/Edit', [
            'procedure' => $procedure
        ]);
    }

    public function update(ProcedureRequest $request, Procedure $procedure): RedirectResponse
    {
        $procedure->update($request->validated());
        Cache::flush();
        return redirect()->route('procedures.index');
    }

    public function destroy(Procedure $procedure): void
    {
        $procedure->delete();
        Cache::flush();
    }
}
