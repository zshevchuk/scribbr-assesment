<?php

namespace App\Parser;

use App\Contract\FactoryInterface;
use App\Contract\FileParserInterface;
use Symfony\Component\HttpFoundation\File\File;

// TODO Use Symfony factory
class FactoryParser implements FactoryInterface
{
    /**
     * Return corresponding parser in regards to a file extension
     */
    public static function create(File $file): FileParserInterface
    {
        $extension = $file->getExtension();

        $parserClass = ucfirst($extension) . 'FileParser';
        $namespaced = sprintf(__NAMESPACE__ . "\\%s", $parserClass);

        if (!class_exists($namespaced)) {
            throw new \RuntimeException($namespaced . ' does not exist');
        }

        return new $namespaced;
    }
}

