<?php

namespace App\Services;

use App\Models\User;
use App\Notifications\VerifyEmailNotification;

class UserService {

    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function register(Array $input) {
        $user = $this->user->create([
            'nome' => $input['nome'],
            'cpf' => $input['cpf'],
            'telefone' => $input['telefone'],
            'email' => $input['email'],
            'password' => bcrypt($input['password']),
        ]);

        return $user;
    }
}

?>