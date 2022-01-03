<?php

namespace App\Model;

use App\Enum\MinusScales;
use Symfony\Component\Validator\Mapping\ClassMetadata;
use Symfony\Component\Validator\Constraints as Assert;

class Search
{
    public ?\DateTime $date;
    public string $scale;

    public function __construct(\DateTime $date = null, string $scale = MinusScales::CELSIUS)
    {
        $this->scale = $scale;
        $this->date = $date;
    }

    public function getDate(): ?\DateTime
    {
        return $this->date;
    }

    public function getScale(): string
    {
        return $this->scale;
    }

    public function isDateOverDue(): bool
    {
        return $this->getDate() > new \DateTime('+10 days');
    }

    public static function loadValidatorMetadata(ClassMetadata $metadata): void
    {
        $metadata->addPropertyConstraint(
            'date',
            new Assert\NotBlank()
        );

        $choices = [MinusScales::CELSIUS, MinusScales::FAHRENHEIT];
        $metadata->addPropertyConstraint(
            'scale',
            new Assert\Choice([
                'choices' => $choices,
                'message' => 'Choose a valid scale. ' . implode(' or ', $choices),
            ])
        );

        $metadata->addPropertyConstraint(
            'date',
            new Assert\GreaterThanOrEqual('today')
        );

        $metadata->addGetterConstraint(
            'DateOverDue',
            new Assert\IsFalse([
                'message' => 'Date must be not later than 10 days from now',
            ])
        );


    }
}
