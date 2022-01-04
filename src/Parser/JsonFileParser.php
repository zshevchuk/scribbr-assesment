<?php

namespace App\Parser;

use Symfony\Component\HttpFoundation\File\File;

class JsonFileParser extends PredictionFileParser
{
    public function getContent(File $file): array
    {
        $outer = (array)json_decode($file->getContent());
        return (array)$outer['predictions'];
    }

    public function getTimestamps(array $content): array
    {
        return $content['prediction'];
    }

    public function getScale(array $element): ?string
    {
        return $element['-scale'];
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
