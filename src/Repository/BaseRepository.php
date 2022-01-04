<?php

namespace App\Repository;

use App\Contract\RepositoryInterface;

abstract class BaseRepository implements RepositoryInterface
{
    public function fetch() {}

    public function connect() {}
}
