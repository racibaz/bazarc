<?php

namespace App\Http\Controllers\Api;

use App\Contracts\Repositories\ActivityLogRepository as Repository;
use App\Models\ActivityLog;
use Illuminate\Http\JsonResponse;


class ActivityLogController extends ApiController
{
    /**
     * @var $repository
     */
    private $repository;

    /**
     * ActivityLogController constructor.
     *
     * @param Repository $repository
     */
    public function __construct(Repository $repository)
    {
        parent::__construct();

        $this->repository = $repository;
    }

    /**
     * activityLog list
     * @return mixed
     */
    public function index()
    {
        $records = $this->repository->all();

        return $this->showAll($records);
    }

    /**
     * @param ActivityLog $record
     * @return JsonResponse
     */
    public function show(ActivityLog $record)
    {
        return $this->showOne($record);
    }


}
