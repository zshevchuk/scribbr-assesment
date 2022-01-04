<?php

namespace App\Utils;

use App\Contract\ConvertableInterface;
use App\Model\Scale\CelsiusBaseScale\FactoryCelsiusBaseScales;

/**
 * Converts supplied scaled by using Celsius as a common denominator by converting it to a base scale and then to a required
 */
final class CelsiusBaseScaleConverter
{
    public static function convert($scaleFrom, $scaleTo, $amount)
    {
        if ($scaleFrom == $scaleTo) {
            return $amount;
        }


        $scaleToConverter = self::getScale($scaleTo);
        $scaleFromConverter = self::getScale($scaleFrom);

        $amountInCelsius = $scaleFromConverter::convertToBase($amount);

        return $scaleToConverter::convertFromBase($amountInCelsius);
    }

    private static function getScale($scale): ConvertableInterface
    {
        return FactoryCelsiusBaseScales::create($scale);
    }
}
