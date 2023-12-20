<?php

namespace App\Services\Auth;

use App\Interfaces\AuthServiceInterface;
use App\Interfaces\Service;
use App\Models\Balance;
use App\Models\User;
use App\Models\UserSocial;
use App\Notifications\WelcomeNotify;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class RegisterService implements Service, AuthServiceInterface
{
    protected const RULES = [
        'login' => ['required', 'string'],
        'email' => ['required', 'email'],
        'password' => ['required', 'confirmed'],
        'password_confirmation' => ['required'],
    ];

    protected string $login = '';
    protected string $email = '';
    protected string $password = '';
    protected string $password_confirmation = '';

    protected array $errors = [];
    protected bool $fail = false;

    protected User $user;


    public function init(array $data = []): static
    {
        $this->login = $data['login'] ?? '';
        $this->email = $data['email'] ?? '';
        $this->password = $data['password'] ?? '';
        $this->password_confirmation = $data['password_confirmation'] ?? '';
        return $this;
    }

    public function validate(): bool
    {

        $validator = Validator::make([
            'login' => $this->login,
            'email' => $this->email,
            'password' => $this->password,
            'password_confirmation' => $this->password_confirmation,
        ], static::RULES);

        if ($validator->fails()) {
            $this->errors = $validator->errors()->toArray();
            return false;
        }

        if ($this->loginExists()) {
            $this->errors = [__('User with this login already exists')];
            return false;
        }

        if ($this->emailExists()) {
            $this->errors = [__('User with this email already exists')];
            return false;
        }

        return true;
    }

    public function store(): void
    {
        try {
            DB::beginTransaction();

            $this->user = User::create([
                'login' => $this->login,
                'email' => $this->email,
                'password' => Hash::make($this->password),
                'referrer_id' => $this->getReferrer(),
                'ref_code' => $this->refCode(),
            ]);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            $this->fail = true;
            Log::error(__('Error while creating user: ') . $e->getMessage());
            $this->errors = [__('Registration error')];
            throw new \Exception($e->getMessage());
        }

    }

    public function createSocials(): void
    {
        UserSocial::create(['user_id' => $this->user->id]);
    }

    public function createBalance(): void
    {
        Balance::create(['user_id' => $this->user->id]);
    }

    public function user(): User
    {
        return $this->user;
    }

    public function getErrors(): array
    {
        return $this->errors ?? [];
    }

    public function fail(): bool
    {
        return $this->fail;
    }

    public function welcomeMailNotify()
    {
        $this->user->notify(new WelcomeNotify());
    }

    public function responseSuccess(): JsonResponse
    {
        return response()->json([
            'message' => __('Registration successful'),
            'status' => 'success',
        ], 200);
    }

    private function refCode(int $length = 8): string
    {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
        $code = '';

        for ($i = 0; $i < $length; $i++) {
            $code .= $characters[rand(0, strlen($characters) - 1)];
        }

        return $code;
    }

    private function loginExists()
    {
        return User::where('login', $this->login)->exists();
    }

    private function emailExists()
    {
        return User::where('email', $this->email)->exists();
    }

    private function getReferrer()
    {
        if (Session::has('ref_code')) {
            $code = Session::get('ref_code');
            return User::where('ref_code', $code)->value('id');
        }
        return null;
    }

}

