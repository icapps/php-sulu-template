<?php

namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

/**
 * @Annotation
 */
final class MinimalPropertiesValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint): void
    {
        if (empty($value) || !isset($value['lat']) || !isset($value['lon'])) {
            $this->context->buildViolation($constraint->message)->addViolation();
        }
    }
}
