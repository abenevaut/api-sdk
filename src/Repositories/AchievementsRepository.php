<?php

namespace abenevaut\ApiSdk\Repositories;

use abenevaut\ApiSdk\Contracts\ApiRepositoryAbstract;
use Illuminate\Support\Collection;

final class AchievementsRepository extends ApiRepositoryAbstract
{
    /**
     * @return Collection
     */
    public function all(): Collection
    {
        return $this
            ->request()
            ->get($this->makeUrl("/achievements"))
            ->collect();
    }
}
