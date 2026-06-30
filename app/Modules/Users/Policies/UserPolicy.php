<?php

namespace App\Modules\Users\Policies;

use App\Modules\Users\Models\User;

class UserPolicy
{
    /**
     * Create a new policy instance.
     */
    public function delete(User $user)
    {
        return $user->email === 'usop@mugiwara.local';
    }
}
