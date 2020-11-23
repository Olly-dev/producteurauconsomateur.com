<?php

declare(strict_types=1);

namespace App\Validator;

use App\Validator\EmailExists;
use App\Repository\UserRepository;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

/**
 * Class EmailExistsValidator
 * @package App\Validator
 */
class EmailExistsValidator extends ConstraintValidator
{
    private UserRepository $userRepository;

    /**
     * EmailExistsValidator constructor
     *
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function validate($value, Constraint $constraint)
    {
        if ($value === null || $value === '' || $this->userRepository->count(["email" => $value]) > 0) {
            return;
        }

        /**
         * @var EmailExits $constraint
         */
        $this->context->buildViolation($constraint->message)->addViolation();
    }
}
