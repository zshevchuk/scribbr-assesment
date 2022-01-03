<?php

namespace App\Contract;

interface RepositoryInterface
{
    public function fetch();

    public function connect();
}
