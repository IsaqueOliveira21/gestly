<?php

namespace App\Services;

use App\Models\User;

class UserService {

    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

}

?>