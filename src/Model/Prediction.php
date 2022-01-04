<?php

namespace App\Model;

class Prediction
{
    protected string $date;
    protected string $city;
    protected array $predictions;
    protected string $scale;

    public function __construct(string $date, string $city, string $scale)
    {
        $this->date = $date;
        $this->city = $city;
        $this->scale = $scale;
    }

    public function pushTimePrediction(string $time, string $value): void
    {
        $this->predictions[] = new TimePrediction(time: $time, value: $value);
    }

    public function getPredictions(): ?array
    {
        return $this->predictions;
    }

    public function getScale(): string
    {
        return $this->scale;
    }

}
