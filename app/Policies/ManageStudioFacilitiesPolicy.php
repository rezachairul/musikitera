<?php

namespace App\Policies;

use App\Models\admin\bph\tentang_ukmbsm\ManageStudioFacilities;
use App\Models\admin\administrator\User;
use Illuminate\Auth\Access\Response;

class ManageStudioFacilitiesPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, ManageStudioFacilities $manageStudioFacilities): bool
    {
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, ManageStudioFacilities $manageStudioFacilities): bool
    {
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, ManageStudioFacilities $manageStudioFacilities): bool
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, ManageStudioFacilities $manageStudioFacilities): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, ManageStudioFacilities $manageStudioFacilities): bool
    {
        return false;
    }
}
