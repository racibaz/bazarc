<?php

namespace App\Repositories\Eloquent;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Contracts\Repositories\ImpersonateRepositoryRepository;
use App\Models\ImpersonateRepository;
use App\Validators\ImpersonateRepositoryValidator;

/**
 * Class ImpersonateRepositoryRepositoryEloquent.
 *
 * @package namespace App\Repositories\Eloquent;
 */
class ImpersonateRepositoryEloquent extends BaseRepository implements ImpersonateRepositoryRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return ImpersonateRepository::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
