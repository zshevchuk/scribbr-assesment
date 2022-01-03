<?php

namespace App\Utils;

use App\Model\Prediction;

class PredictionNormalizer
{
    /**
     * Convert scales if necessary
     */
    public static function normilize(Prediction $prediction, $scaleTo)
    {
        $predictions = $prediction->getPredictions();
        $scaleFrom = $prediction->getScale();

        foreach ($predictions as &$timePrediction) {
            $converted = CelsiusBaseScaleConverter::convert($scaleFrom, $scaleTo, $timePrediction->getValue());
            $timePrediction->setValue($converted);
        }

        return $predictions;
    }
}
