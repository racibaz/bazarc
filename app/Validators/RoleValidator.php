<?php

namespace App\Validators;

use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\LaravelValidator;

/**
 * Class RoleValidator.
 */
class RoleValidator extends LaravelValidator
{
    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'name' => 'required|min:3|string|unique:roles',
            'guard_name' => 'required',
        ],
        ValidatorInterface::RULE_UPDATE => [
            'name' => 'required|min:3|string|unique:roles',
            'guard_name' => 'required',
        ],
    ];
}
