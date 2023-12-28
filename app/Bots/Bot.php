<?php

namespace App\Bots;

use App\Contracts\BotContract;
use Illuminate\Support\Facades\Log;

abstract class Bot implements BotContract
{
    protected string|null $token;
    protected string $name;

    protected Client $client;

    abstract static public function init(?string $chatId = null, ?string $token = null): static;

    abstract public function sendMessage(string $message): void;

    public function logSuccessfulMessage(string $chatId, string $message): void
    {
        Log::info("{$this->name}Bot [{$this->token}] sent message to {$chatId}: {$message}");
    }

    public function logFailedMessage(string $chatId, string $message, int $statusCode): void
    {
        Log::error("{$this->name}Bot  [{$this->token}] failed to send message to {$chatId}: {$message}. Status code: {$statusCode}");
    }
}
