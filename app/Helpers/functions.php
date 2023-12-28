<?php

// if (!function_exists('')) {
//     function FunctionName(): Returntype
//     {
//     }
// }

if (!function_exists('formatCryptoAmount')) {
    function formatCryptoAmount($amount, $decimals = 8)
    {
        return number_format($amount, $decimals, '.', '');
    }
}

if (!function_exists('formatFiatAmount')) {
    function formatFiatAmount($amount, $decimals = 2)
    {
        return number_format($amount, $decimals, '.', ',');
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


if (!function_exists('walletTypes')) {
    function walletTypes($name = ''): mixed
    {
        $types = config('trade.currencies.types');
        if ($name) {
            return $types[$name];
        }
        return $types;
    }
}


if (!function_exists('img')) {
    function img($image)
    {
        return  asset(Storage::url('images/' . $image));
    }
}
