<?php

namespace App\Contract;

use Symfony\Component\HttpFoundation\File\File;

interface FileParserInterface
{
    public function parse(File $file);
}
