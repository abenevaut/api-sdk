<?php

namespace Tests\Unit;

use abenevaut\ApiSdk\Contracts\ApiProviderNameInterface;
use abenevaut\ApiSdk\Factories\ApiDriverFactory;
use abenevaut\ApiSdk\Providers\ApiServiceProvider;
use Illuminate\Foundation\Application;
use Mockery as m;
use PHPUnit\Framework\TestCase;

class FoundationApplicationTest extends TestCase
{
    protected function tearDown(): void
    {
        m::close();
    }

    public function testServiceProvidersAreCorrectlyRegistered()
    {
        $app = new Application();
        $app->register(ApiServiceProvider::class);
        $this->assertArrayHasKey(ApiServiceProvider::class, $app->getLoadedProviders());
    }

    public function testSingletonsAreCreatedWhenServiceProviderIsRegistered()
    {
        $app = new Application();
        $app->register(ApiServiceProvider::class);
        $instance = $app->make(ApiProviderNameInterface::ABENEVAUT);

        $this->assertInstanceOf(ApiDriverFactory::class, $instance);
        $this->assertSame($instance, $app->make(ApiProviderNameInterface::ABENEVAUT));
    }
}
