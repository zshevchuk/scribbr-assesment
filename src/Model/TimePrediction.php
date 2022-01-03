<?php

namespace App\Model;

class TimePrediction
{
    protected string $time;
    protected string $value;

    public function __construct(string $time, string $value)
    {
        $this->time = $time;
        $this->value = $value;
    }

    public function getTime(): string
    {
        return $this->time;
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function setTime(string $time)
    {
        $this->time = $time;
    }

    public function setValue(string $value)
    {
        $this->value = $value;
    }
}
