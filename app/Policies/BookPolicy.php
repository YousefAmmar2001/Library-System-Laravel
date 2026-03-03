<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\Book;
use Illuminate\Auth\Access\HandlesAuthorization;

class BookPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny($user)
    {
        $guard = auth('admin')->check() ? 'admin' : 'user';
        return auth($guard)->user()->hasPermissionTo('Read-Books')
            ? $this->allow()
            : $this->deny();
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(Admin $admin, Book $book)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create($user)
    {
        if (auth('user')->check()) return $this->deny();
        return auth('admin')->user()->hasPermissionTo('Create-Book', 'admin')
            ? $this->allow()
            : $this->deny();
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update($user, Book $book)
    {
        if (auth('user')->check()) return $this->deny();
        return auth('admin')->user()->hasPermissionTo('Update-Book', 'admin')
            ? $this->allow()
            : $this->deny();
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete($user, Book $book)
    {
        if (auth('user')->check()) return $this->deny();
        return auth('admin')->user()->hasPermissionTo('Delete-Book', 'admin')
            ? $this->allow()
            : $this->deny();
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore($user, Book $book)
    {
        if (auth('user')->check()) return $this->deny();
        return auth('admin')->user()->hasPermissionTo('Restore-Book', 'admin')
            ? $this->allow()
            : $this->deny();
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(Admin $admin, Book $book)
    {
        //
    }
}
