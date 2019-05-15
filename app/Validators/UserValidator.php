<?php
/**
 * Created by PhpStorm.
 * User: muhammed.cansiz
 * Date: 15-May-19
 * Time: 12:03 PM
 */

namespace App\Validators;

use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\LaravelValidator;

class UserValidator extends LaravelValidator {

    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'name'                          => 'required|min:3|string',
            'email'                         => 'required|unique:users|email',
            'email_verified_at'             => 'nullable|date_format',
            'slug'                          => 'required|string',
            'cell_phone'                    => 'nullable|integer',
            'web_site'                      => 'nullable|url',
            'gender'                        => 'nullable|boolean',
            'bio_note'                      => 'nullable|text',
            'IP'                            => 'nullable|ip',
            'last_login'                    => 'nullable|date_format',
            'previous_visit'                => 'nullable|date_format'
        ],
        ValidatorInterface::RULE_UPDATE => [
            'name'                          => 'required|min:3|string',
            'email'                         => 'required|unique:users|email',
            'email_verified_at'             => 'nullable|date_format',
            'slug'                          => 'required|string',
            'cell_phone'                    => 'nullable|integer',
            'web_site'                      => 'nullable|url',
            'gender'                        => 'nullable|boolean',
            'bio_note'                      => 'nullable|text',
            'IP'                            => 'nullable|ip',
            'last_login'                    => 'nullable|date_format',
            'previous_visit'                => 'nullable|date_format'
        ]
    ];
}