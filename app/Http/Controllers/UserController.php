<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('users.index', [
            'users' => User::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users.create', [
            'roles' => Role::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

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
    public function edit(User $user)
    {
        return view('users.edit', [
            'user' => $user,
            'roles' => Role::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
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

            return redirect()->route('users.index')->with('success', 'User updated successfully!');
        } catch (\Exception $e) {
            return redirect()->route('users.edit', $user->id)->withInput()->with('error', 'An error occurred while updating the user. Please try again.');
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }
}
