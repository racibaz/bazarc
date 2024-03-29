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

class UserValidator extends LaravelValidator
{
    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'name'                          => 'required|min:3|string',
            'email'                         => 'required|unique:users|email',
            'password'                      => 'required|min:4',
            'email_verified_at'             => 'nullable|date',
//            'slug'                          => 'required|unique:users|string',
            //todo it should be image validation and formats
            'photo'                         => 'nullable',
            'cell_phone'                    => 'nullable|string',
            'web_site'                      => 'nullable|url',
            'gender'                        => 'nullable|boolean',
            'bio_note'                      => 'nullable|string',
            'IP'                            => 'nullable|ip',
            'last_login'                    => 'nullable|date',
            'previous_visit'                => 'nullable|date'
        ],

        ValidatorInterface::RULE_UPDATE => [
            'name'                          => 'required|min:3|string',
            'email'                         => 'required|unique:users|email',
            'email_verified_at'             => 'nullable|date',
            'password'                      => 'sometimes|min:4',
//            'slug'                          => 'required|unique:users|string',
            //todo it should be image validation and formats
            'photo'                         => 'nullable',
            'cell_phone'                    => 'nullable|string',
            'web_site'                      => 'nullable|url',
            'gender'                        => 'nullable|boolean',
            'bio_note'                      => 'nullable|string',
            'IP'                            => 'nullable|ip',
            'last_login'                    => 'nullable|date',
            'previous_visit'                => 'nullable|date'
        ]
    ];
}