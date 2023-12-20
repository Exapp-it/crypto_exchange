<?php

if (!function_exists('moneyFormat')) {
    function moneyFormat($amount): string
    {
        return number_format($amount, 2, '.', '');
    }
}
