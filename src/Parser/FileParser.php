<?php

namespace App\Parser;

use App\Contract\FileParserInterface;

abstract class FileParser implements FileParserInterface
{
    public function __construct() {}
}
