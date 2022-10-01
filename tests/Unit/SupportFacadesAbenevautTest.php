<?php

namespace Tests\Unit;

use abenevaut\ApiSdk\Contracts\ApiProviderNameInterface;
use abenevaut\ApiSdk\Facades\Abenevaut;
use abenevaut\ApiSdk\Factories\ApiDriverFactory;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Facade;
use PHPUnit\Framework\TestCase;

class SupportFacadesHttpTest extends TestCase
{
    protected Application $app;

    protected function setUp(): void
    {
        $this->app = new Application();
        $this->app->singleton(ApiProviderNameInterface::ABENEVAUT, ApiDriverFactory::class);

        Facade::setFacadeApplication($this->app);
    }

    public function testFacadeRootIsBound(): void
    {
        $this->assertSame(Abenevaut::getFacadeRoot(), $this->app->make(ApiProviderNameInterface::ABENEVAUT));
        $this->assertNotSame(Abenevaut::getFacadeRoot(), $this->app->make(ApiDriverFactory::class));
    }
}
