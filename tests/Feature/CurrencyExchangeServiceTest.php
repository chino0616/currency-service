<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Services\CurrencyExchangeService;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CurrencyExchangeServiceTest extends TestCase
{
    protected $service;

    protected function setUp(): void
    {
        parent::setUp();
        $this->service = $this->app->make(CurrencyExchangeService::class);
    }

    public function testConversionWithValidData()
    {
        $result = $this->service->convert('USD', 'JPY', '1525');
        $this->assertEquals('170,496.53', $result);
    }

    public function testConversionWithCommaData()
    {
        $result = $this->service->convert('USD', 'JPY', '1,525');
        $this->assertEquals('170,496.53', $result);

        $result = $this->service->convert('USD', 'JPY', '1,525,525');
        $this->assertEquals('170,555,220.53', $result);
    }

    public function testConversionWithRounding()
    {
        $result = $this->service->convert('USD', 'JPY', '1,525');
        $this->assertEquals('170,496.53', $result);

        $result = $this->service->convert('USD', 'JPY', '1525');
        $this->assertEquals('170,496.53', $result);

        $result = $this->service->convert('USD', 'JPY', '1525.555');
        $this->assertEquals('170,558.57', $result);
    }


    public function testConversionWithInvalidSource()
    {
        $this->expectException(\Exception::class);
        $this->service->convert('ABC', 'JPY', '1525');
    }

    public function testConversionWithInvalidTarget()
    {
        $this->expectException(\Exception::class);
        $this->service->convert('USD', 'XYZ', '1525');
    }

    public function testConversionWithInvalidAmount()
    {
        $this->expectException(\Exception::class);
        $this->service->convert('USD', 'JPY', 'invalid');
    }
}
