<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CurrencyExchangeController;

Route::get('/convert', [CurrencyExchangeController::class, 'convert']);
