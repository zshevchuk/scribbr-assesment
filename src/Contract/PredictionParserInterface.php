<?php

namespace App\Contract;

interface PredictionParserInterface
{
    public function getScale(array $row): ?string;

    public function getDate(array $row): ?string;

    public function getCity(array $row): ?string;

    public function getTime(array $row): ?string;

    public function getValue(array $row): ?string;
}
