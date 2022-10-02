<?php

namespace abenevaut\ApiSdk\Entities;

use Spatie\DataTransferObject\DataTransferObject;

class AchievementEntity extends DataTransferObject
{
    /** @var string $uniqid */
    public string $uniqid;

    /** @var string $status */
    public $status;

    /** @var string $name */
    public $name;

    /** @var string $images */
    public $images;

    /** @var string $url */
    public $url;

    /** @var string $createdAt */
    public $createdAt;
}