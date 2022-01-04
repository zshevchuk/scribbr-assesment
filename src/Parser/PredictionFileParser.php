<?php

namespace App\Parser;

use App\Contract\FileParserInterface;
use App\Contract\PredictionParserInterface;
use App\Model\Prediction;
use Symfony\Component\HttpFoundation\File\File;

abstract class PredictionFileParser implements FileParserInterface, PredictionParserInterface
{
    public function __construct() {}

    public function parse(File $file)
    {
        $content = $this->getContent($file);

        if (!$content) {
            throw new \Exception("Couldn't parse file");
        }

        $date = $this->getDate($content);
        $scale = $this->getScale($content);
        $city = $this->getCity($content);

        $Prediction = new Prediction(date: $date, scale: $scale, city: $city);

        $timestamps = $this->getTimestamps($content);

        foreach ($timestamps as $row) {
            $rowContent = (array)$row;
            $time = $this->getTime($rowContent);
            $value = $this->getValue($rowContent);

            $Prediction->appendTimePrediction($time, $value);
        }

        return $Prediction;
    }

    abstract public function getContent(File $file): array;

    abstract public function getTimestamps(array $content): array;
}
