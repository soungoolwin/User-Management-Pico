<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;

class RolePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(): bool
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(): bool
    {
        //
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(): bool
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(): bool
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(): bool
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(): bool
    {
        //
    }
}
