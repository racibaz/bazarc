<?php

namespace App\Models;

use App\Presenters\PermissionPresenter;
use App\Transformers\PermissionTransformer;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Permission.
 *
 * @package namespace App\Models;
 */
class Permission extends \Spatie\Permission\Models\Permission implements Transformable
{
    use TransformableTrait;

    public $transformer = PermissionTransformer::class;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [];
    protected $presenter = PermissionPresenter::class;

}
