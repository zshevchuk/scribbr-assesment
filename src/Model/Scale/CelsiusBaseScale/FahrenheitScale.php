<?php

namespace App\Model\Scale\CelsiusBaseScale;

use App\Model\Scale\CelsiusBaseScale;

class FahrenheitScale extends CelsiusBaseScale
{
    public static function convertFromBase($amount): float
    {
        return ($amount * 1.8) + 32;
    }

    public static function convertToBase($amount): float
    {
        return ($amount - 32) * 0.555;
    }
}
