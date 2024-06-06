<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Services\CurrencyExchangeService;

class CurrencyExchangeServiceTest extends TestCase
{
    protected $service;

    protected function setUp(): void
    {
        parent::setUp();
        $this->service = new CurrencyExchangeService();
    }

    public function testConversionWithValidData()
    {
        $result = $this->service->convert('USD', 'JPY', 1525);
        $this->assertEquals(170496.53, $result);
    }

    public function testConversionWithInvalidSource()
    {
        $this->expectException(\Exception::class);
        $this->service->convert('ABC', 'JPY', 1525);
    }

    public function testConversionWithInvalidTarget()
    {
        $this->expectException(\Exception::class);
        $this->service->convert('USD', 'XYZ', 1525);
    }

    public function testConversionWithInvalidAmount()
    {
        $this->expectException(\Exception::class);
        $this->service->convert('USD', 'JPY', 'invalid');
    }
}
