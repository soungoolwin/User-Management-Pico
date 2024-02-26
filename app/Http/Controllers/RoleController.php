<?php

namespace App\Http\Controllers;

use App\Models\Feature;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class RoleController extends Controller
{
    protected $role;
    public function __construct()
    {
        $this->role = new Role();
    }

    public function index()
    {
        $this->role->authorizeAction('viewAny');
        return view('roles.index', [
            'roles' => Role::all()
        ]);
    }

    public function create()
    {
        $this->role->authorizeAction('create');
        return view('roles.create', [
            'permissions' => Permission::all(),
            'features' => Feature::all()
        ]);
    }

    public function store(Request $request)
    {
        $this->role->authorizeAction('create');
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
    }

    public function edit(Role $role)
    {
        $this->role->authorizeAction('update');
        return view('roles.edit', [
            'role' => $role,
            'permissions' => Permission::all(),
            'features' => Feature::all()
        ]);
    }

    public function update(Request $request, Role $role)
    {

        $this->role->authorizeAction('update');

        $validatedData = $request->validate([
            'name' => 'required|string',
        ]);
        try {
            $role->update($validatedData);
            $selectedPermissions = $request->input('permissions');
            $permissions = Permission::whereIn('id', $selectedPermissions)->get();
            $role->permissions()->sync($permissions);

            if (Gate::allows('viewAny')) {
                return redirect()->route('roles.index')->with('success', 'Role updated successfully!');
            } else {
                return redirect()->route('dashboard');
            }
        } catch (\Exception $e) {
            return redirect()->route('roles.edit', $role->id)->withInput()->with('error', 'An error occurred while updating the role. Please try again.');
        }
    }

    public function destroy(Role $role)
    {
        $this->role->authorizeAction('delete');
        $role->delete();

        return redirect()->route('roles.index')->with('success', 'Role deleted successfully.');
    }
}
