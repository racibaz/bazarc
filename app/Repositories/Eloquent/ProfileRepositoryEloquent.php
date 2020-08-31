<?php

namespace App\Repositories\Eloquent;

use App\Contracts\Repositories\ProfileRepository;
use App\Models\Profile;
use App\Validators\ProfileValidator;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * Class ProfileRepositoryRepositoryEloquent.
 */
class ProfileRepositoryEloquent extends BaseRepository implements ProfileRepository
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
        return Profile::class;
    }

    /**
     * @return string
     */
    public function presenter()
    {
//        return ProfilePresenter::class;
    }

    /**
     * Specify Validator class name.
     *
     * @return mixed
     */
    public function validator()
    {
        return ProfileValidator::class;
    }

    /**
     * Boot up the repository, pushing criteria.
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
