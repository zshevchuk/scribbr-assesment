<?php

namespace App\Parser;

use App\Contract\FileParserInterface;
use App\Contract\PredictionParserInterface;
use App\Model\Prediction;
use Symfony\Component\HttpFoundation\File\File;

class XmlFileParser extends FileParser implements FileParserInterface, PredictionParserInterface
{
    public function parse(File $file)
    {
        $xml = (array)simplexml_load_file($file->getPathname()) or throw new \Exception("Couldn't parse file");

        $date = $this->getDate($xml);
        $scale = $this->getScale($xml);
        $city = $this->getCity($xml);

        $Prediction = new Prediction(date: $date, scale: $scale, city: $city);

        foreach ($xml['prediction'] as $content) {
            $content = (array)$content;
            $time = $this->getTime($content);
            $value = $this->getValue($content);

            $Prediction->appendTimePrediction($time, $value);
        }

        return $Prediction;
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
