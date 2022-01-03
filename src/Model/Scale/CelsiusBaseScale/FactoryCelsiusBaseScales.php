<?php

namespace App\Model\Scale\CelsiusBaseScale;

use App\Contract\FactoryInterface;

// TODO Use Symfony factory
class FactoryCelsiusBaseScales implements FactoryInterface
{
    public static function create($scale)
    {
        $scale = ucfirst($scale) . 'Scale';
        $namespaced = sprintf(__NAMESPACE__ . "\\%s", $scale);

        if (!class_exists($namespaced)) {
            throw new \RuntimeException($namespaced . ' does not exist');
        }

        return new $namespaced;
    }
}

