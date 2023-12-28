<?php

namespace App\Services;

use App\Models\Order;
use Auth;
use DB;
use Log;
use Response;
use Validator;

class OrderService
{
    protected const RULES = [
        'quantity' => ['required', 'numeric', 'min:0'],
        'from_currency' => ['required'],
        'price' => ['required', 'numeric', 'min:0'],
        'to_currency' => ['required'],
    ];

    protected string $quantity = '';
    protected string $from_currency = '';
    protected string $price = '';
    protected string $to_currency = '';
    protected string $total = '';
    protected string $type = '';

    protected array $errors = [];
    protected bool $fail = false;

    public function __construct(array $data)
    {
        $this->quantity = $data['quantity'] ?? '';
        $this->from_currency = $data['from_currency'] ?? '';
        $this->price = $data['price'] ?? '';
        $this->to_currency = $data['to_currency'] ?? '';
    }

    public static function init(array $data): static
    {
        return new static($data);
    }

    public function validate(): bool
    {
        $validator = Validator::make([
            'quantity' => $this->quantity,
            'from_currency' => $this->from_currency,
            'price' => $this->price,
            'to_currency' => $this->to_currency,
        ], static::RULES);

        if ($validator->fails()) {
            $this->errors = $validator->errors()->toArray();
            return false;
        }
        return true;
    }

    public function store(): void
    {
        try {
            DB::beginTransaction();

            Order::create([
                'user_id' => Auth::user()->id,
                'type' => $this->type(),
                'currency_pair' => $this->currencyPair(),
                'price' => $this->price,
                'quantity' => $this->quantity,
                'total' => $this->total(),
            ]);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            $this->fail = true;
            Log::error(__('Error while creating order: ') . $e->getMessage());
            $this->errors = [__('Order error')];
            throw new \Exception($e->getMessage());
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

    public function success()
    {
        return Response::json([
            'message' => __('Order successful created'),
            'status' => 'success',
        ], 200);
    }

    public function currencyPair()
    {
        return $this->from_currency . '/' . $this->to_currency;
    }

    protected function total()
    {
        return $this->quantity * $this->price;
    }

    public function type($type = '')
    {
        return $type ? $this->type = $type : $this->type;
    }

    public function calculateFee()
    {
        $fee = 0.04;
        return $this->quantity * $fee;
    }

    public function currencyFrom()
    {
        return $this->from_currency;
    }

    public function currencyTo()
    {
        return $this->to_currency;
    }

    public function checkBalance($balance)
    {
        $fee = formatCryptoAmount($this->calculateFee());
        if ((float) $balance < $this->total()) {
            $this->errors = ['error' => "<b> {$this->total()} {$this->to_currency} → {$this->quantity} {$this->from_currency} (" . __('price') . ": {$this->price} {$this->to_currency}, " . __('fee') . ": {$fee} {$this->from_currency}) </b> <br/> You do not have sufficient funds on your account"];
            return false;
        }
        return true;
    }
}
