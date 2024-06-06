<?php

namespace App\Http\Controllers;

use App\Http\Requests\CurrencyExchangeRequest;
use App\Services\CurrencyExchangeService;
use Illuminate\Http\Request;

class CurrencyExchangeController extends Controller
{
    protected $currencyExchangeService;
    public function __construct(CurrencyExchangeService $currencyExchangeService)
    {
        $this->currencyExchangeService = $currencyExchangeService;
    }

    public function convert(CurrencyExchangeRequest $request)
    {
        $validated = $request->validated();
        $result = $this->currencyExchangeService->convert($validated['source'], $validated['target'], $validated['amount']);

        return response()->json([
            'msg' => 'success',
            'amount' => $result
        ]);
    }
}
