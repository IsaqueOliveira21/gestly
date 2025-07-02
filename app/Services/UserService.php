<?php

namespace App\Services;

use App\Models\User;
use App\Notifications\VerifyEmailNotification;
use Exception;
use Illuminate\Auth\AuthenticationException;
use RuntimeException;

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

    public function login(Array $input) {
        try {
            $authAttempt = auth()->attempt($input);
            if(!$authAttempt) {
                throw new AuthenticationException("E-mail ou senha incorretos.");
            }
            $token = explode("|", auth()->user()->createToken('accessToken')->plainTextToken)[1];

            return [
                'user' => auth()->user(), 
                'token' => $token
            ];
        } catch(Exception $e) {
            throw new RuntimeException("Ocorreu um erro, tente novamente mais tarde.");
        }
    }
}

?>