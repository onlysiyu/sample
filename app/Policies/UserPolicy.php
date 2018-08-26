<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;


    public function __construct()
    {
        //
    }


    public function update(User $currentUser, User $user)
    {
        //echo 111;exit();
        return $currentUser->id === $user->id;
    }


    public function destroy(User $currentUser, User $user)
    {
        return $currentUser->is_admin && $currentUser->id !== $user->id;
    }
}
