<?php

namespace App\Contracts;

interface BotContract
{
    public function init(?string $chatId = null, ?string $token = null): void;

    public function sendMessage(string $message): void;

    public function logSuccessfulMessage(string $chatId, string $message): void;

    public function logFailedMessage(string $chatId, string $message, int $statusCode): void;
}
