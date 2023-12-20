<?php

namespace App\Bots;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

class Client
{
    protected string $url;
    protected string $queryMethod;

    public function __construct(string $url)
    {
        $this->url = $url;
    }

    public function post(array $params = [], array $headers = []): Response
    {
        return $this->request('POST', $params, $headers);
    }

    public function get(array $params = [], array $headers = []): Response
    {
        return $this->request('GET', $params, $headers);
    }

    public function request(string $method, array $params = [], array $headers = []): Response
    {
        if ($this->queryMethod) {
            $this->url .= $this->queryMethod;
        }
        return Http::withHeaders($headers)->$method($this->url, $params);
    }

    public function queryMethod(string $method): static
    {
        $this->queryMethod = $method;
        return $this;
    }
}
