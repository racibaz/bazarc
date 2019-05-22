<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Setting.
 *
 * @package namespace App\Models;
 */
class Setting extends Model implements Transformable
{
    use TransformableTrait;

    public static $registrationTypes = [
        'public' => [
            'name' => 'Public',
            'number' => 1
        ],
        'private' => [
            'name' => 'Private',
            'number' => 2
        ],
        'verified' => [
            'name' => 'VERIFIED',
            'number' => 3
        ],
        'none' => [
            'name' => 'None',
            'number' => 4
        ]
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['attribute_key', 'attribute_value', 'description', 'is_active'];

}
