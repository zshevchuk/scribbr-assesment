<?php

namespace App\Parser;

use Symfony\Component\HttpFoundation\File\File;

class XmlFileParser extends PredictionFileParser
{
    public function getContent(File $file): array
    {
        $content = simplexml_load_file($file->getPathname());

        return (array)$content;
    }

    public function getTimestamps(array $content): array
    {
        return $content['prediction'];
    }

    public function getScale(array $element): ?string
    {
        return (string)$element['@attributes']['scale'];
    }

    public function getDate(array $element): ?string
    {
        return $element['date'];
    }

    public function getCity(array $element): ?string
    {
        return $element['city'];
    }

    public function getTime(array $row): ?string
    {
        return $row['time'];
    }

    public function getValue(array $row): ?string
    {
        return $row['value'];
    }

}
