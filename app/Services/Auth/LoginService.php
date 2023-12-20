<?php

namespace App\Services\Auth;

use App\Interfaces\AuthServiceInterface;
use App\Interfaces\Service;
use App\Models\User;
use Auth;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class LoginService implements Service, AuthServiceInterface
{

    protected const RULES = [
        'login' => ['required', 'string'],
        'password' => ['required', 'string'],
    ];

    protected string $login = '';
    protected string $password = '';

    protected array $errors = [];
    protected bool $fail = false;

    public function init(array $data = []): static
    {
        $this->login = $data['login'] ?? '';
        $this->password = $data['password'] ?? '';
        return $this;
    }

    public function validate(): bool
    {

        $validator = Validator::make([
            'login' => $this->login,
            'password' => $this->password,
        ], static::RULES);

        if ($validator->fails()) {
            $this->errors = $validator->errors()->toArray();
            return false;
        }

        if ($this->userExists()) {
            return true;
        } else {
            $this->errors = [__('A user with this data does not exist')];
            return false;
        }
    }

    public function store(): void
    {
        $credentials = $this->getCredentials();

        if (!Auth::attempt($credentials)) {
            $this->fail = true;
            $this->errors = [__('Auth error')];
        }

    }

    public function getErrors(): array
    {
        return $this->errors;
    }

    public function fail(): bool
    {
        return $this->fail;
    }

    public function responseSuccess(): JsonResponse
    {
        return response()->json([
            'message' => __('Auth successful'),
            'status' => 'success',
        ], 200);
    }

    private function userExists()
    {
        $user = User::where('login', $this->login)->first();

        if ($user && Hash::check($this->password, $user->password)) {
            return true;
        }
        return false;
    }

    private function getCredentials()
    {
        return ['login' => $this->login, 'password' => $this->password];
    }

}
