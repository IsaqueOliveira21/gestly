<?php

namespace App\Http\Controllers;

use App\Http\Resources\AuthResource;
use App\Models\User;
use App\Services\UserService;
use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Throwable;

class UserController extends Controller
{
    private $service;

    public function __construct(UserService $userService) {
        $this->service = $userService;
    }

    public function register(Request $request) {
        try {
            $input = $request->validate([
                'nome' => 'string|required',
                'cpf' => 'string|required',
                'telefone' => 'string|required',
                'email' => 'string|required',
                'password' => 'string|required|min:8',
            ]);

            $user = $this->service->register($input);

            event(new Registered($user));

            return response()->json(['message' => 'Cadastro realizado com sucesso. Verifique seu e-mail.']);
        } catch(Exception $e) {
            return response()->json(['error' => "Ocorreu um erro, tente novamente mais tarde."], 500);
        }
    }

    public function verifyEmail(Request $request, $id, $hash) {
        $user = User::findOrFail($id);

        if(!hash_equals((string) $hash, sha1($user->getEmailForVerification()))) {
            return response()->json(['message' => "Link de verificacao invalido."]);
        }

        if(!$request->hasValidSignature()) {
            return response()->json(['message' => "Link expirado ou invalido."]);
        }

        if($user->hasVerifiedEmail()) {
            return response()->json(["Message" => "E-mail ja verificado."]);
        }

        $user->markEmailAsVerified();
        event(new Verified($user));

        return response()->json(['message' => "E-mail verificado com sucesso."]);
    }

    public function login(Request $request) {
        try {
            $input = $request->validate([
                'email' => 'string|email|required',
                'password' => 'string|required|min:8|max:30',
            ]);
            $res = $this->service->login($input);
            return new AuthResource($res);
        } catch(AuthenticationException $e) {
            return response()->json(['error' => $e->getMessage()], 401);
        } catch(Throwable $e) {
            return response()->json(['error' => "Ocorreu um erro, tente novamente mais tarde."], 500);
        }
    }

    public function logout() {
        try {
            $this->service->logout();
            return response()->json(['message' => 'Logout realizado com sucesso!'], 200);
        } catch(Throwable $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
