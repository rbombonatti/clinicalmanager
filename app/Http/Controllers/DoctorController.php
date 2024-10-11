<?php

namespace App\Http\Controllers;

use App\Http\Requests\Doctor\DoctorRequest;
use App\Models\{Doctor, Role, Specialty};
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;

class DoctorController extends Controller
{
    public function index(Request $request): Response
    {
        $search = $request->get('search');
        $doctors = Doctor::withRelations()->search($search);

        $doctors = $doctors->paginate(4);
        return Inertia::render('Doctors/Index', [
            'doctors' => $doctors,
            'request' => $request,
        ]);
    }

    public function edit(Doctor $doctor): Response
    {
        $doctor = $doctor->load('specialties', 'role');
        return Inertia::render('Doctors/Edit',
            [
                'doctor' => $doctor,
                'roles' => Role::all(),
                'specialties' => Specialty::all(),
                'doctorSpecialties' => $doctor->specialties->pluck('id')->toArray(),
            ]);
    }

    public function update(DoctorRequest $request, Doctor $doctor): RedirectResponse
    {
        $doctor->update($request->validated());
        $doctor->specialties()->sync($request->input('specialties'));
        return redirect('/doctors');
    }

    public function show(Doctor $doctor): Response
    {
        return Inertia::render('Doctors/Show',
            [
                'doctor' => $doctor->load('specialties', 'role')
            ]
        );
    }

    public function create(): Response
    {
        return Inertia::render('Doctors/Create',
            [
                'roles' => Role::all(),
                'specialties' => Specialty::all()
            ]
        );
    }

    public function store(DoctorRequest $request): RedirectResponse
    {
        $doctor = Doctor::create($request->validated());
        $doctor->specialties()->attach($request->input('specialties'));
        return redirect('/doctors');
    }

    public function destroy(Doctor $doctor): void
    {
        $doctor->delete();
    }
}
