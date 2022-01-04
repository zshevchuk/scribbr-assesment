<?php

namespace App\Model;

class PredictionsCollection
{
    /**
     * %time => [Partner1_prediction, Partner2_prediction]
     */
    protected array $hashMap = [];

    public function addPrediction(TimePrediction $prediction): void
    {
        $predictionTime = $prediction->getTime();
        $predictionValue = $prediction->getValue();

        $this->setValue($predictionTime, $predictionValue);
    }

    public function addPredictions(array $predictions): void
    {
        foreach ($predictions as $prediction) {
            $this->addPrediction($prediction);
        }
    }

    public function getHashMap(): array
    {
        return $this->hashMap;
    }

    public function setValue(string $key, string $value)
    {
         $this->hashMap[$key][] = $value;
    }

    public function finalize(): array
    {
        $predictions = $this->getHashMap();

        foreach ($predictions as $time => $temperatures) {
            $predictions[$time] = ceil(array_sum($temperatures) / count($temperatures));
        }

        return $predictions;
    }
}
