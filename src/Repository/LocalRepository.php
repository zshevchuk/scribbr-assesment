<?php

namespace App\Repository;

use App\Model\Prediction;
use App\Model\PredictionsCollection;
use App\Parser\FactoryParser;
use Symfony\Component\HttpFoundation\File\File;

class LocalRepository extends PartnerRepository
{
    public function __construct($path)
    {
        parent::__construct($path);
    }

    public function fetch(): Prediction
    {
        $path = $this->getPath();

        $file = new File($path, true);

        $parser = FactoryParser::create($file);

        $content = $parser->parse($file);

        return $content;

    }
}
