<?php

namespace App\Http\Controllers\Api\User;

use App\Contracts\Repositories\UserRepository as Repo;
use App\Http\Controllers\Api\ApiController;
use App\Models\User;

class UserController extends ApiController
{
    /**
     * @var $repo
     */
    private $repo;

    /**
     * UserController constructor.
     * @param Repo $repo
     */
    public function __construct(Repo $repo)
    {
        parent::__construct();

        $this->repo = $repo;
    }

    /**
     * user list
     * @return mixed
     */
    public function index()
    {
        $users = $this->repo->all();

        return $this->showAll($users);
    }

    /**
     * @param User $record
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(User $record)
    {
        return $this->showOne($record);
    }
}
