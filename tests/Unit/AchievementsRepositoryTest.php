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
            'https://api.benevaut.test/achievements' => Http::response([
                "data" => [],
                "pagination" => [
                    "total" => 0,
                    "per_page" => 12,
                    "current_page" => 1,
                    "previous_page_url" => null,
                    "next_page_url" => null
                ]
            ]),
        ]);

        $instance = new AchievementsRepository('https://api.benevaut.test', true);

        $collection = $instance->all();

        $this->assertArrayHasKey('data', $collection->toArray());
        $this->assertEmpty($collection->toArray()['data']);
        $this->assertNotEmpty($collection->toArray()['pagination']);
    }
}
