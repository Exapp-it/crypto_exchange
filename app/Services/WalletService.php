<?php

namespace App\Services;

use App\Models\Currency;
use App\Models\User;
use App\Models\Wallet;

class WalletService
{
    public function create(User $user): void
    {
        $currencies = Currency::where('status', true)->get();
        if ($currencies) {
            foreach ($currencies as $currency) {
                Wallet::firstOrCreate(
                    ['user_id' => $user->id, 'curr' => $currency->symbol],
                    ['type' => $currency->type]
                );
            }
        }
    }
}
