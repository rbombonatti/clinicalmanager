<?php

namespace App\Http\Controllers;

use App\Http\Requests\Role\RoleRequest;
use App\Models\Role;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class RoleController extends Controller
{

    public function index(Request $request): Response
    {
        $search = $request->query('search');
        $roles = Role::search($search)->paginate(4);
        return Inertia::render('Roles/Index',
            [
                'roles' => $roles,
                'request' => $request
            ]);
    }

    public function create(): Response
    {
        return Inertia::render('Roles/Create');
    }

    public function store(RoleRequest $request): RedirectResponse
    {
        Role::create($request->validated());
        return redirect()->route('roles.index');
    }

    public function show(Role $role): Response
    {
        return Inertia::render('Roles/Show',
        [
            'role' => $role
        ]);
    }

    public function edit(Role $role): Response
    {
        return Inertia::render('Roles/Edit', [
            'role' => $role
        ]);
    }

    public function update(RoleRequest $request, Role $role): RedirectResponse
    {
        $role->update($request->validated());
        return redirect()->route('roles.index');
    }

    public function destroy(Role $role): void
    {
        $role->delete();
    }
}
