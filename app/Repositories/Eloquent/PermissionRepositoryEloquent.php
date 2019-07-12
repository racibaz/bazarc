<?php

namespace App\Repositories\Eloquent;

use App\Presenters\PermissionPresenter;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Contracts\Repositories\PermissionRepository;
use App\Models\Permission;
use App\Validators\PermissionValidator;

/**
 * Class PermissionRepositoryEloquent.
 *
 * @package namespace App\Repositories\Eloquent;
 */
class PermissionRepositoryEloquent extends BaseRepository implements PermissionRepository
{
    /**
     * @var bool
     */
    protected $skipPresenter = true;

    /**
     * Specify Model class name
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
     * Specify Validator class name
     *
     * @return mixed
     */
    public function validator()
    {
        return PermissionValidator::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
