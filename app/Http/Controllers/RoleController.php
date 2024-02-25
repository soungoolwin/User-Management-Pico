<?php

namespace App\Http\Controllers;

use App\Models\Feature;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $permissionId = 6;

        if (Gate::allows('has-permission', $permissionId)) {
            return view('roles.index', [
                'roles' => Role::all()
            ]);
        } else {
            return redirect()->back()->with('error', 'Your are not allowed to do this');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $permissionId = 5;

        if (Gate::allows('has-permission', $permissionId)) {
            return view('roles.create', [
                'permissions' => Permission::all(),
                'features' => Feature::all()
            ]);
        } else {
            return redirect()->back()->with('error', 'Your are not allowed to do this');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $permissionId = 5;

        if (Gate::allows('has-permission', $permissionId)) {
            $role = Role::create([
                'name' => $request->input('role_name'),
            ]);

            $selectedPermissions = $request->input('permissions');
            $permissions = Permission::whereIn('id', $selectedPermissions)->get();
            $role->permissions()->attach($permissions);

            return redirect()->route('roles.index')->with('success', 'New Role added successfully.');
        } else {
            return redirect()->back()->with('error', 'Your are not allowed to do this');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        $permissionId = 7;

        if (Gate::allows('has-permission', $permissionId)) {
            return view('roles.edit', [
                'role' => $role,
                'permissions' => Permission::all(),
                'features' => Feature::all()
            ]);
        } else {
            return redirect()->back()->with('error', 'Your are not allowed to do this');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {

        $permissionId = 7;

        if (Gate::allows('has-permission', $permissionId)) {
            $validatedData = $request->validate([
                'name' => 'required|string',
            ]);

            try {

                $role->update($validatedData);
                $selectedPermissions = $request->input('permissions');
                $permissions = Permission::whereIn('id', $selectedPermissions)->get();
                $role->permissions()->sync($permissions);

                return redirect()->route('roles.index')->with('success', 'Role updated successfully!');
            } catch (\Exception $e) {
                return redirect()->route('roles.edit', $role->id)->withInput()->with('error', 'An error occurred while updating the role. Please try again.');
            }
        } else {
            return redirect()->back()->with('error', 'Your are not allowed to do this');
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        $permissionId = 7;

        if (Gate::allows('has-permission', $permissionId)) {
            $role->delete();

            return redirect()->route('roles.index')->with('success', 'Role deleted successfully.');
        } else {
            return redirect()->back()->with('error', 'Your are not allowed to do this');
        }
    }
}
