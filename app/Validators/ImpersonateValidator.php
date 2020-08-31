<?php

namespace App\Validators;

use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\LaravelValidator;

/**
 * Class ImpersonateValidatorValidator.
 */
class ImpersonateValidator extends LaravelValidator
{
    /**
     * Validation Rules.
     *
     * @var array
     */
    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'email' => 'required|email|exists:users,email',
        ],
        ValidatorInterface::RULE_UPDATE => [
            'email' => 'required|email|exists:users,email',
        ],
    ];
}
