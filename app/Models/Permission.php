<?php

namespace App\Models;

use App\Presenters\PermissionPresenter;
use App\Transformers\PermissionTransformer;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Permission.
 */
class Permission extends \Spatie\Permission\Models\Permission implements Transformable
{
    use TransformableTrait;

    public $transformer = PermissionTransformer::class;
    protected $fillable = [];
    protected $presenter = PermissionPresenter::class;
}
