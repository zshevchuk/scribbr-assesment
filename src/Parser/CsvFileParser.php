<?php

namespace App\Parser;

use App\Enum\CsvMappingEnum;

class CsvFileParser extends PredictionFileParser
{
    public function getContent($file): array
    {
         $csvContent = array_map('str_getcsv', file($file->getPathname()));
         // remove header
         array_shift($csvContent);

         return $csvContent;
    }

    public function getTimestamps(array $content): array
    {
        return $content;
    }

    public function getScale(array $row): ?string
    {
        return $row[0][CsvMappingEnum::SCALE_COLUMN];
    }

    public function getDate(array $row): ?string
    {
        return $row[0][CsvMappingEnum::DATE_COLUMN];
    }

    public function getCity(array $row): ?string
    {
        return $row[0][CsvMappingEnum::CITY_COLUMN];
    }

    public function getTime(array $row): ?string
    {
        return $row[CsvMappingEnum::TIME_COLUMN];
    }

    public function getValue(array $row): ?string
    {
        return $row[CsvMappingEnum::VALUE_COLUMN];
    }
}
