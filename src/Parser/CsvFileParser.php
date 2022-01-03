<?php

namespace App\Parser;

use App\Contract\FileParserInterface;
use App\Contract\PredictionParserInterface;
use App\Enum\CsvMappingEnum;
use App\Model\Prediction;
use Symfony\Component\HttpFoundation\File\File;

class CsvFileParser extends FileParser implements FileParserInterface, PredictionParserInterface
{
    public function parse(File $file): Prediction
    {
        // we do not care about memory, so we dont need to use streams here
        $csvContent = array_map('str_getcsv', $this->getContent($file));

        // here we could've parser mapping to get lines
        $mapping = array_shift($csvContent);
        // we assuming that format is gonna be always the same
        $header = $csvContent[0];

        $date = $this->getDate($header);
        $scale = $this->getScale($header);
        $city = $this->getCity($header);

        $Prediction = new Prediction(date: $date, scale: $scale, city: $city);

        foreach($csvContent as $content) {
            $time = $this->getTime($content);
            $value = $this->getValue($content);

            $Prediction->appendTimePrediction($time, $value);
        }

        return $Prediction;
    }

    public function getContent($file): array|false
    {
        return file($file->getPathname());
    }

    public function getScale(array $row): ?string
    {
        return $row[CsvMappingEnum::SCALE_COLUMN];
    }

    public function getDate(array $row): ?string
    {
        return $row[CsvMappingEnum::DATE_COLUMN];
    }

    public function getCity(array $row): ?string
    {
        return $row[CsvMappingEnum::CITY_COLUMN];
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
