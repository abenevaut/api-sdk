<?php

namespace abenevaut\ApiSdk\Factories;

use abenevaut\ApiSdk\Contracts\ApiRepositoryAbstract;
use abenevaut\ApiSdk\Contracts\ApiDriversEnum;
use Illuminate\Foundation\Application;

class ApiDriverFactory
{
    /**
     * @param  Application  $app
     */
    public function __construct(private Application $app)
    {
    }

    /**
     * @param  ApiDriversEnum  $driver
     * @return ApiRepositoryAbstract
     */
    public function request(ApiDriversEnum $driver): ApiRepositoryAbstract
    {
        return $this
            ->app
            ->make('\\abenevaut\\ApiSdk\\Repositories\\'.$driver->value.'Repository', [
                'baseUrl' => $this->app->config('abenevaut.endpoint'),
                'debug' => $this->app->config('app.debug'),
            ]);
    }
}
