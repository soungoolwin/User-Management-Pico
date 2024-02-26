<?php

namespace App\Policies;

use Illuminate\Support\Facades\Auth;

class RolePolicy
{
    public function viewAny(): bool
    {
        $user = Auth::user();
        return $user->role->permissions()->where('role_permissions.permission_id', 6)->exists();
    }

    public function create(): bool
    {
        $user = Auth::user();
        return $user->role->permissions()->where('role_permissions.permission_id', 5)->exists();
    }

    public function update(): bool
    {
        $user = Auth::user();
        return $user->role->permissions()->where('role_permissions.permission_id', 7)->exists();
    }

    public function delete(): bool
    {
        $user = Auth::user();
        return $user->role->permissions()->where('role_permissions.permission_id', 8)->exists();
    }
}
