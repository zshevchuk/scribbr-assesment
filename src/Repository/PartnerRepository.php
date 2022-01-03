<?php

namespace App\Repository;

use App\Contract\PredictionsRepositoryInterface;
use App\Contract\RepositoryInterface;
use App\Model\Prediction;

class PartnerRepository extends BaseRepository implements PredictionsRepositoryInterface, RepositoryInterface
{
    protected string $path;

    public function __construct($path)
    {
        $this->path = $path;
    }

    public function getPredictions()
    {
    }

    public function fetch()
    {
        return true;
    }

    public function getPath(): string
    {
        return $this->path;
    }

    public function connect()
    {
        // TODO: Implement connect() method.
    }
}
