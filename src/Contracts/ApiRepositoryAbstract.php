<?php

namespace abenevaut\ApiSdk\Contracts;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

abstract class ApiRepositoryAbstract
{
    /**
     * @var string
     */
    private string $baseUrl = 'https://api.benevaut.fr/api/v1';

    /**
     * @param  string  $uri
     * @return string
     */
    protected function makeUrl(string $uri): string
    {
        return "{$this->baseUrl}{$uri}";
    }

    /**
     * @return PendingRequest
     */
    protected function request(): PendingRequest
    {
        return $this
            ->withHeaders()
            ->retry(3, 100);
    }

    /**
     * @param  bool  $withToken
     * @param  array  $requestHeaders
     * @return PendingRequest
     */
    private function withHeaders(bool $withToken = false, array $requestHeaders = []): PendingRequest
    {
        $defaultHeaders = [];
        $pendingRequest = Http::withHeaders(array_merge($defaultHeaders, $requestHeaders));

        if ($withToken) {
            $pendingRequest->withToken(config('asana.access_token'));
        }

        return $pendingRequest;
    }
}
