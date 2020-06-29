<?php

namespace App\Repositories;

use App\Traits\{ EloquentTrait, StorageTrait, DatatableTrait };

abstract class BaseRepository
{
    use EloquentTrait, StorageTrait, DatatableTrait;
}