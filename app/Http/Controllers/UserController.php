<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{
    protected $user;
    public function __construct()
    {
        $this->user = new User();
    }

    public function index()
    {
        $this->user->authorizeAction('viewAny');
        return view('users.index', [
            'users' => User::all()
        ]);
    }

    public function create()
    {
        $this->user->authorizeAction('create');
        return view('users.create', [
            'roles' => Role::all()
        ]);
    }

    public function store(Request $request)
    {

        $this->user->authorizeAction('create');
        $validatedData = $request->validate([
            'name' => 'required|string',
            'username' => 'required|unique:users',
            'role_id' => 'required|exists:roles,id',
            'phone' => 'nullable|string',
            'email' => 'required|email|unique:users',
            'address' => 'nullable|string',
            'password' => 'required|string|confirmed',
            'password_confirmation' => 'required|string',
            'gender' => 'required|boolean',
        ]);

        try {
            $user = new User();
            $user->fill($validatedData);
            $user->save();

            return redirect()->route('users.index')->with('success', 'User created successfully!');
        } catch (\Exception $e) {
            return redirect()->route('users.create')->withInput()->with('error', 'An error occurred while creating the user. Please try again.');
        }
    }

    public function edit(User $user)
    {
        $this->user->authorizeAction('update');
        return view('users.edit', [
            'user' => $user,
            'roles' => Role::all()
        ]);
    }

    public function update(Request $request, User $user)
    {
        $this->user->authorizeAction('update');
        $validatedData = $request->validate([
            'name' => 'required|string',
            'username' => 'required|unique:users,username,' . $user->id,
            'role_id' => 'required|exists:roles,id',
            'phone' => 'nullable|string',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'address' => 'nullable|string',
            'password' => 'nullable|string|confirmed',
            'password_confirmation' => 'nullable|string',
            'gender' => 'required|boolean',
        ]);

        try {
            $user->update($validatedData);
            if (Gate::allows('viewAny', User::class)) {

                return redirect()->route('users.index')->with('success', 'User updated successfully!');
            } else {
                return redirect()->route('dashboard');
            }
        } catch (\Exception $e) {
            return redirect()->route('users.edit', $user->id)->withInput()->with('error', 'An error occurred while updating the user. Please try again.');
        }
    }

    public function destroy(User $user)
    {
        $this->user->authorizeAction('delete');
        $user->delete();

        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }
}
