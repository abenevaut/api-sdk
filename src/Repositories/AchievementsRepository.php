<?php

namespace abenevaut\ApiSdk\Repositories;

use abenevaut\ApiSdk\Contracts\ApiEntitiesEnum;
use abenevaut\ApiSdk\Contracts\ApiRepositoryAbstract;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;

final class AchievementsRepository extends ApiRepositoryAbstract
{
    /**
     * @return LengthAwarePaginator
     */
    public function all(): LengthAwarePaginator
    {
        $response = $this
            ->request()
            ->get($this->makeUrl("/achievements"))
            ->json();

        $resources = Collection::make($response['data'])
            ->toApiEntity(ApiEntitiesEnum::ACHIEVEMENT);

        return new LengthAwarePaginator(
            $resources,
            $resources->count(),
            $response['pagination']['per_page'],
            $response['pagination']['current_page']
        );
    }
}
