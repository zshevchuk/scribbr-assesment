<?php

namespace App\Model;

use App\Repository\LocalRepository;
use App\Utils\PredictionNormalizer;

class PartnersCollection
{
    protected array $partners;

    public function __construct(array $partners)
    {
        $this->partners = $partners;
    }

    public function getPartners(): array
    {
        return $this->partners;
    }

    public function getData(PredictionsCollection $predictionsCollection, $scale, $date)
    {
        $partnersMap = $this->getPartners();

        foreach ($partnersMap as $value) {
            // TODO: create a smart factory to get correct Partner Type (Local, File, Remote) etc
            // based on date path would be changed
            $partner = new LocalRepository($value['path']);
            $prediction = $partner->fetch();
            $normalized = PredictionNormalizer::normilize($prediction, $scale);

            $predictionsCollection->addPredictions($normalized);
        }

        return $predictionsCollection->finalize();
    }
}
