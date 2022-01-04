<?php

namespace App\Tests\Model;

use App\Model\PredictionsCollection;
use App\Model\TimePrediction;
use PHPUnit\Framework\TestCase;

class PredictionsCollectionTest extends TestCase
{
    public ?PredictionsCollection $PredictionsCollection;

    public function setUp(): void
    {
        $this->PredictionsCollection = new PredictionsCollection();
    }

    public function tearDown(): void
    {
        $this->PredictionsCollection = null;
    }

    public function mockTimePrediction(string $time = "10:00", string $value = "100"): TimePrediction
    {
        return new TimePrediction($time, $value);
    }

    public function testGetHashMap()
    {
        $this->PredictionsCollection->setValue("10:00", "100");
        $map = $this->PredictionsCollection->getHashMap();

        $this->assertSame(["10:00" => ["100"]], $map);
    }

    public function testAddPredictions()
    {
        $prediction = $this->mockTimePrediction();

        $this->PredictionsCollection->addPrediction($prediction);

        $map = $this->PredictionsCollection->getHashMap();

        $this->assertSame(["10:00" => ["100"]], $map);
    }

    public function testFinalize()
    {
        $predictions = [
            $this->mockTimePrediction("10", "10"),
            $this->mockTimePrediction("10", "100"),
            $this->mockTimePrediction("20", "30"),
            $this->mockTimePrediction("20", "60"),
            $this->mockTimePrediction("30", "50"),
        ];

        $this->PredictionsCollection->addPredictions($predictions);

        $finalized = $this->PredictionsCollection->finalize();

        $this->assertSame(
            [
                10 => 55.0,
                20 => 45.0,
                30 => 50.0,
            ], $finalized);
    }
}
