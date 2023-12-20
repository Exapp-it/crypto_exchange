<?php

namespace App\Interfaces;

interface AuthServiceInterface
{
    public function validate(): bool;

    public function store(): void;

    public function getErrors(): array;

    public function fail(): bool;

    public function responseSuccess();
}
