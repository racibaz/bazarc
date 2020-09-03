<?php

namespace App\Repositories\Eloquent;

use App\Contracts\Repositories\PermissionRepository;
use App\Models\Permission;
use App\Presenters\PermissionPresenter;
use App\Validators\PermissionValidator;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * Class PermissionRepositoryEloquent.
 */
class PermissionRepositoryEloquent extends BaseRepository implements PermissionRepository
{
    /**
     * @var bool
     */
    protected $skipPresenter = true;

    /**
     * Specify Model class name.
     *
     * @return string
     */
    public function model()
    {
        return Permission::class;
    }

    /**
     * @return string
     */
    public function presenter()
    {
        return PermissionPresenter::class;
    }

    /**
     * Specify Validator class name.
     *
     * @return mixed
     */
    public function validator()
    {
        return PermissionValidator::class;
    }

    /**
     * Boot up the repository, pushing criteria.
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
