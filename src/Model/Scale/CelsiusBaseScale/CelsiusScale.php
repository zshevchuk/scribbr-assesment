<?php

namespace App\Model\Scale\CelsiusBaseScale;

use App\Model\Scale\CelsiusBaseScale;

class CelsiusScale extends CelsiusBaseScale
{
    public static function convertFromBase($amount)
    {
        return $amount;
    }

    public static function convertToBase($amount)
    {
        return $amount;
    }
}
