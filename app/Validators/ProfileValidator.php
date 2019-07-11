<?php

namespace App\Validators;

use Illuminate\Foundation\Testing\RefreshDatabase;
use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

/**
 * Class ProfileValidator.
 *
 * @package namespace App\Validators;
 */
class ProfileValidator extends LaravelValidator
{
    use RefreshDatabase;

    /**
     * Validation Rules
     *
     * @var array
     */
    protected $rules = [
        ValidatorInterface::RULE_UPDATE => [
            'name'                          => 'required|min:3|string',
            'email'                         => 'required|unique:users|email',
            'email_verified_at'             => 'nullable|date',
//            'slug'                          => 'required|unique:users|string',
            'cell_phone'                    => 'nullable|string',
            'web_site'                      => 'nullable|url',
            'gender'                        => 'nullable|boolean',
            'bio_note'                      => 'nullable|string',
            'IP'                            => 'nullable|ip',
            'last_login'                    => 'nullable|date',
            'previous_visit'                => 'nullable|date'
        ],
    ];
}
