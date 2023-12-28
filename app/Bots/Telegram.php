<?php

namespace App\Bots;

class Telegram extends Bot
{
    protected string $chatId;
    private string $baseUrl = 'https://api.telegram.org/bot';



    public function __construct(?string $chatId = null, ?string $token = null)
    {
        $this->name = 'Telegram';
        $this->token = $token ?? config('bot.telegram.token');
        $this->chatId = $chatId ?? config('bot.telegram.account');
        $this->client = new Client($this->baseUrl . $this->token . '/');
    }

    public static function init(?string $chatId = null, ?string $token = null): static
    {
        return new static($chatId, $token);
    }

    public function sendMessage(string $message): void
    {
        $response = $this->client
            ->queryMethod('sendMessage')
            ->post([
                'chat_id' => $this->chatId,
                'text' => $message,
                'parse_mode' => 'HTML',
            ]);

        if ($response->successful()) {
            $this->logSuccessfulMessage($this->chatId, $message);
        } else {
            $this->logFailedMessage($this->chatId, $message, $response->status());
        }
    }
}
