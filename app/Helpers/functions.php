<?php

if (!function_exists('moneyFormat')) {
    function moneyFormat($amount): string
    {
        return number_format($amount, 2, '.', '');
    }
}

if (!function_exists('currnetLanguage')) {
    function currnetLanguage(): string
    {
        return App::getLocale();
    }
}


if (!function_exists('languages')) {
    function languages(): array
    {
        return config('locales.lang');
    }
}
