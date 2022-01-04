<?php

namespace App\Enum;

class MinusScales
{
    const CELSIUS = "celsius";

    const FAHRENHEIT = "fahrenheit";

    public static $scalesMap = [
        self::CELSIUS,
        self::FAHRENHEIT
    ];
}
