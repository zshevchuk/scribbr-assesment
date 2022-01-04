<?php

namespace App\Model;

use App\Enum\MinusScales;
use Symfony\Component\Validator\Mapping\ClassMetadata;
use Symfony\Component\Validator\Constraints as Assert;

class Search
{
    public string $date;
    public string $scale;

    public function __construct(string $date, string $scale = MinusScales::CELSIUS)
    {
        $this->scale = $scale;
        $this->date = $date;
    }

    public function getDate(): string
    {
        return $this->date;
    }

    public function getScale(): string
    {
        return $this->scale;
    }

    public function isDateOverDue(): bool
    {
        return strtotime($this->getDate()) > strtotime('+10 days');
    }

    public function isDatePast(): bool
    {
        return strtotime('today') > strtotime($this->getDate());
    }

    public static function loadValidatorMetadata(ClassMetadata $metadata): void
    {
        $metadata->addPropertyConstraint(
            'date',
            new Assert\NotBlank()
        );

        $metadata->addPropertyConstraint(
            'date',
            new Assert\Date([
                'message' => 'Please provide date in YYYY-MM-DD format',
            ])
        );

        $metadata->addPropertyConstraint(
            'scale',
            new Assert\Choice([
                'choices' => MinusScales::$scalesMap,
                'message' => 'Choose a valid scale. ' . implode(' or ', MinusScales::$scalesMap),
            ])
        );

        $metadata->addGetterConstraint(
            'DatePast',
            new Assert\IsFalse([
                'message' => 'Date cannot be a past one',
            ])
        );

        $metadata->addGetterConstraint(
            'DateOverDue',
            new Assert\IsFalse([
                'message' => 'Date must be not later than 10 days from now',
            ])
        );
    }
}
