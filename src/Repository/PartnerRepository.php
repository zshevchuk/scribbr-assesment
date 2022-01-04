<?php

namespace App\Repository;

use App\Contract\PredictionsRepositoryInterface;
use App\Contract\RepositoryInterface;

class PartnerRepository extends BaseRepository implements PredictionsRepositoryInterface, RepositoryInterface
{
    protected string $path;

    public function __construct($path)
    {
        $this->path = $path;
    }

    public function getPredictions() {}

    public function getPath(): string
    {
        return $this->path;
    }
}
