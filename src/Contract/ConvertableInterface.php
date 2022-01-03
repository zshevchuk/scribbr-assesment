<?php

namespace App\Contract;

interface ConvertableInterface
{
    public static function convertToBase($amount);
    public static function convertFromBase($amount);
}
