<?php

namespace App\Services;

use Exception;

class CurrencyExchangeService
{
    protected $rates = [
        'TWD' => [
            'TWD' => 1,
            'JPY' => 3.669,
            'USD' => 0.03281,
        ],
        'JPY' => [
            'TWD' => 0.26956,
            'JPY' => 1,
            'USD' => 0.00885,
        ],
        'USD' => [
            'TWD' => 30.444,
            'JPY' => 111.801,
            'USD' => 1,
        ],
    ];

    public function convert(string $source, string $target, string $amount)
    {
        $amount = str_replace(',', '', $amount);
        if (!isset($this->rates[$source]) || !isset($this->rates[$source][$target])) {
            throw new Exception("Currency not supported.");
        }

        if (!is_numeric($amount)) {
            throw new Exception("Invalid amount.");
        }

        $rate = $this->rates[$source][$target];
        $result = $amount * $rate;

        return round($result, 2);
    }
}
