<?php

namespace App\Model\Scale;

use App\Contract\ConvertableInterface;
use App\Enum\MinusScales;

abstract class CelsiusBaseScale implements ConvertableInterface
{
    /**
     * Current available list of minus scale for this particular base(to be convertable)
     */
    public static function getScalesMap()
    {
        return [
            MinusScales::CELSIUS => MinusScales::CELSIUS,
            MinusScales::FAHRENHEIT => MinusScales::FAHRENHEIT,
        ];
    }

    abstract static function convertFromBase($amount);
    abstract static function convertToBase($amount);

}
