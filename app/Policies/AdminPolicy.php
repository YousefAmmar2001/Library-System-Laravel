<?php

namespace App\Policies;

use App\Models\Admin;
use Illuminate\Auth\Access\HandlesAuthorization;

class AdminPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(Admin $admin)
    {
        return $admin->hasPermissionTo('Read-Admins', 'admin')
            ? $this->allow()
            : $this->deny();
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Admin  $targetAdmin
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(Admin $admin, Admin $targetAdmin)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(Admin $admin)
    {
        return $admin->hasPermissionTo('Create-Admin', 'admin')
            ? $this->allow()
            : $this->deny();
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Admin  $targetAdmin
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(Admin $admin, Admin $targetAdmin)
    {
        if ($admin->id === $targetAdmin->id) {
            return $this->deny('Action Denied: Personal Profile.');
        }

        return $admin->hasPermissionTo('Update-Admin', 'admin')
            ? $this->allow()
            : $this->deny();
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Admin  $targetAdmin
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(Admin $admin, Admin $targetAdmin)
    {
        if ($admin->id === $targetAdmin->id) {
            return $this->deny('Action Denied: Personal Profile.');
        }

        return $admin->hasPermissionTo('Delete-Admin', 'admin')
            ? $this->allow()
            : $this->deny();
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Admin  $targetAdmin
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(Admin $admin, Admin $targetAdmin)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Admin  $targetAdmin
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(Admin $admin, Admin $targetAdmin)
    {
        //
    }
}
