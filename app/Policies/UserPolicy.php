<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Auth;

class UserPolicy
{
    public function viewAny(): bool
    {
        $user = Auth::user();
        return $user->role->permissions()->where('role_permissions.permission_id', 2)->exists();
    }

    public function create(): bool
    {
        $user = Auth::user();
        return $user->role->permissions()->where('role_permissions.permission_id', 1)->exists();
    }

    public function update(): bool
    {
        $user = Auth::user();
        return $user->role->permissions()->where('role_permissions.permission_id', 3)->exists();
    }

    public function delete(): bool
    {
        $user = Auth::user();
        return $user->role->permissions()->where('role_permissions.permission_id', 4)->exists();
    }
}
