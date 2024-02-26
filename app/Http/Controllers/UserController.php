<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{
    public function index()
    {
        if (Gate::allows('viewAny', User::class)) {
            return view('users.index', [
                'users' => User::all()
            ]);
        } else {
            return redirect()->back()->with('error', 'Your are not allowed to do this');
        }
    }

    public function create()
    {
        if (Gate::allows('create', User::class)) {
            return view('users.create', [
                'roles' => Role::all()
            ]);
        } else {
            return redirect()->back()->with('error', 'Your are not allowed to do this');
        }
    }

    public function store(Request $request)
    {

        if (Gate::allows('create', User::class)) {
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
        } else {
            return redirect()->back()->with('error', 'Your are not allowed to do this');
        }
    }

    public function show(string $id)
    {
        //
    }

    public function edit(User $user)
    {
        if (Gate::allows('update', User::class)) {
            return view('users.edit', [
                'user' => $user,
                'roles' => Role::all()
            ]);
        } else {
            return redirect()->back()->with('error', 'Your are not allowed to do this');
        }
    }

    public function update(Request $request, User $user)
    {
        if (Gate::allows('update', User::class)) {
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
        } else {
            return redirect()->back()->with('error', 'Your are not allowed to do this');
        }
    }

    public function destroy(User $user)
    {
        if (Gate::allows('delete', User::class)) {
            $user->delete();

            return redirect()->route('users.index')->with('success', 'User deleted successfully.');
        } else {
            return redirect()->back()->with('error', 'Your are not allowed to do this');
        }
    }
}
