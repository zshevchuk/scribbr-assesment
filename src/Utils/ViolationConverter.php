<?php

namespace App\Utils;

use Symfony\Component\Validator\ConstraintViolationListInterface;

class ViolationConverter
{
    public function violationsToArray(ConstraintViolationListInterface $violations)
    {
        $messages = [];

        foreach ($violations as $constraint) {
            $prop = $constraint->getPropertyPath();
            $messages[$prop][] = $constraint->getMessage();
        }

        return $messages;
    }
}
