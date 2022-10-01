<?php

namespace Tests\Unit;

use abenevaut\ApiSdk\Contracts\ApiProviderNameInterface;
use abenevaut\ApiSdk\Facades\Abenevaut;
use abenevaut\ApiSdk\Factories\ApiDriverFactory;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Facade;
use Mockery as m;
use PHPUnit\Framework\TestCase;

/**
 * https://github.com/laravel/framework/blob/9.x/tests/Support/SupportFacadesEventTest.php
 * https://github.com/laravel/framework/blob/9.x/tests/Support/SupportFacadesHttpTest.php
 */
class SupportFacadesHttpTest extends TestCase
{
    protected Application $app;

    protected function setUp(): void
    {
        $this->app = new Application();
        $this->app->singleton(ApiProviderNameInterface::ABENEVAUT, ApiDriverFactory::class);

        Facade::setFacadeApplication($this->app);
    }

    protected function tearDown(): void
    {
        Abenevaut::clearResolvedInstances();
        Abenevaut::setFacadeApplication(null);

        m::close();
    }

    public function testFacadeRootIsBound(): void
    {
        $this->assertSame(Abenevaut::getFacadeRoot(), $this->app->make(ApiProviderNameInterface::ABENEVAUT));
        $this->assertNotSame(Abenevaut::getFacadeRoot(), $this->app->make(ApiDriverFactory::class));
    }
}
