<?php

namespace App\Services;

use Exception;

class CurrencyExchangeService
{
    protected $rates;
    public function __construct(array $rates)
    {
        $this->rates = $rates;
    }


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

        return number_format(round($result, 2), 2, '.', ',');
    }
}
