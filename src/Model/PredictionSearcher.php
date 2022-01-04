<?php

namespace App\Model;

use App\Utils\PartnersMap;

class PredictionSearcher
{
    public function process(string $scale, \DateTime|string $date): array
    {
        $predictionCollection = new PredictionsCollection();
        $partnersCollection = new PartnersCollection(PartnersMap::getPartners());

        return $partnersCollection->getData($predictionCollection, $scale, $date);
    }
}
