<?php

namespace App\Http\Controllers;

use App\Http\Requests\Specialty\SpecialtyRequest;
use App\Models\Specialty;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class SpecialtyController extends Controller
{
    public function index(Request $request): Response
    {
        $specialties = Specialty::query()->search($request->input('search'))->paginate(4);
        return Inertia::render('Specialties/Index', [
            'specialties' => $specialties,
            'request' => $request
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('Specialties/Create');
    }

    public function store(SpecialtyRequest $request): RedirectResponse
    {
        Specialty::create($request->validated());
        return redirect(route('specialties.index'));
    }

    public function show(Specialty $specialty): Response
    {
        return Inertia::render('Specialties/Show', [
            'specialty' => $specialty
        ]);
    }

    public function edit(Specialty $specialty): Response
    {
        return Inertia::render('Specialties/Edit', [
            'specialty' => $specialty
        ]);
    }

    public function update(SpecialtyRequest $request, Specialty $specialty)
    {
        $specialty->update($request->validated());
        return redirect(route('specialties.index'));
    }

    public function destroy(Specialty $specialty): void
    {
        $specialty->delete();
    }
}
