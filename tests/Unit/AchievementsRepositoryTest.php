<?php

namespace Tests\Unit;

use abenevaut\ApiSdk\Repositories\AchievementsRepository;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Facade;
use Illuminate\Support\Facades\Http;
use PHPUnit\Framework\TestCase;

/**
 * https://github.com/laravel/framework/blob/9.x/tests/Foundation/FoundationApplicationTest.php
 */
class AchievementsRepositoryTest extends TestCase
{
    protected $app;

    protected function setUp(): void
    {
        $this->app = new Application();
        Facade::setFacadeApplication($this->app);
    }

    public function testAll()
    {
        Http::fake([
            'https://api.benevaut.test/achievements' => Http::response(['data' => 'bar']),
        ]);

        $instance = new AchievementsRepository('https://api.benevaut.test', true);

        $collection = $instance->all();

        $this->assertArrayHasKey('data', $collection->toArray());
        $this->assertSame('bar', $collection->toArray()['data']);
    }
}
