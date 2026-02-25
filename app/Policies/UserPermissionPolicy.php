<?php

namespace App\Policies;

use App\Models\Admin;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPermissionPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can manage user-permission.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(Admin $admin)
    {
        return $admin->hasPermissionTo('Manage-User-Permission', 'admin')
            ? $this->allow()
            : $this->deny();
    }
}
