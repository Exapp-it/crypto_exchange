<?php

namespace App\Services\Auth;

use App\Models\User;
use Auth;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class LoginService
{

    protected const RULES = [
        'email' => ['required', 'email'],
        'password' => ['required', 'string'],
    ];

    protected string $email = '';
    protected string $password = '';

    protected array $errors = [];
    protected bool $fail = false;

    public function init(array $data = []): static
    {
        $this->email = $data['email'] ?? '';
        $this->password = $data['password'] ?? '';
        return $this;
    }

    public function validate(): bool
    {

        $validator = Validator::make([
            'email' => $this->email,
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
        $user = User::where('email', $this->email)->first();

        if ($user && Hash::check($this->password, $user->password)) {
            return true;
        }
        return false;
    }

    private function getCredentials()
    {
        return ['email' => $this->email, 'password' => $this->password];
    }
}
