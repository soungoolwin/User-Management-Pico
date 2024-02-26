<?php

namespace App\Http\Controllers;

use App\Models\Feature;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class RoleController extends Controller
{
    public function index()
    {
        if (Gate::allows('viewAny', Role::class)) {
            return view('roles.index', [
                'roles' => Role::all()
            ]);
        } else {
            return redirect()->back()->with('error', 'Your are not allowed to do this');
        }
    }

    public function create()
    {
        if (Gate::allows('create', Role::class)) {
            return view('roles.create', [
                'permissions' => Permission::all(),
                'features' => Feature::all()
            ]);
        } else {
            return redirect()->back()->with('error', 'Your are not allowed to do this');
        }
    }

    public function store(Request $request)
    {
        if (Gate::allows('create', Role::class)) {
            $validatedData = $request->validate([
                'role_name' => 'required|string',
            ]);
            $role = Role::create([
                'name' => $validatedData,
            ]);

            $selectedPermissions = $request->input('permissions');
            $permissions = Permission::whereIn('id', $selectedPermissions)->get();
            $role->permissions()->attach($permissions);

            return redirect()->route('roles.index')->with('success', 'New Role added successfully.');
        } else {
            return redirect()->back()->with('error', 'Your are not allowed to do this');
        }
    }

    public function show(string $id)
    {
        //
    }

    public function edit(Role $role)
    {
        if (Gate::allows('update', Role::class)) {
            return view('roles.edit', [
                'role' => $role,
                'permissions' => Permission::all(),
                'features' => Feature::all()
            ]);
        } else {
            return redirect()->back()->with('error', 'Your are not allowed to do this');
        }
    }

    public function update(Request $request, Role $role)
    {

        if (Gate::allows('update', Role::class)) {

            $validatedData = $request->validate([
                'name' => 'required|string',
            ]);
            try {
                $role->update($validatedData);
                $selectedPermissions = $request->input('permissions');
                $permissions = Permission::whereIn('id', $selectedPermissions)->get();
                $role->permissions()->sync($permissions);

                if (Gate::allows('viewAny', Role::class)) {
                    return redirect()->route('roles.index')->with('success', 'Role updated successfully!');
                } else {
                    return redirect()->route('dashboard');
                }
            } catch (\Exception $e) {
                return redirect()->route('roles.edit', $role->id)->withInput()->with('error', 'An error occurred while updating the role. Please try again.');
            }
        } else {
            return redirect()->back()->with('error', 'Your are not allowed to do this');
        }
    }

    public function destroy(Role $role)
    {
        if (Gate::allows('delete', Role::class)) {
            $role->delete();

            return redirect()->route('roles.index')->with('success', 'Role deleted successfully.');
        } else {
            return redirect()->back()->with('error', 'Your are not allowed to do this');
        }
    }
}
