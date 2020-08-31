<?php

namespace App\Models;

use App\Presenters\RolePresenter;
use App\Transformers\RoleTransformer;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Role.
 */
class Role extends \Spatie\Permission\Models\Role implements Transformable
{
    use TransformableTrait;

    public $transformer = RoleTransformer::class;
    protected $fillable = [];
    protected $presenter = RolePresenter::class;
}
