<?php

namespace App\Interfaces;

interface Service
{
    public function init(array $data = []): mixed;
}
