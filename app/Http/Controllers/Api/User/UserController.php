<?php

namespace App\Http\Controllers\Api\User;

use App\Contracts\Repositories\UserRepository as Repository;
use App\Http\Controllers\Api\ApiController;
use App\Models\User;
use App\Validators\UserValidator;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Str;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;

class UserController extends ApiController
{
    /**
     * @var
     */
    private $repository;

    /**
     * @var UserValidator
     */
    private $validator;

    /**
     * UserController constructor.
     *
     * @param Repository $repository
     * @param UserValidator $validator
     *
     * @internal param \App\Http\Controllers\Api\User\Repo $repo
     */
    public function __construct(Repository $repository, UserValidator $validator)
    {
        parent::__construct();

        $this->repository = $repository;

        $this->validator = $validator;
    }

    /**
     * user list.
     * @return mixed
     */
    public function index()
    {
        $users = $this->repository->all();

        return $this->showAll($users);
    }

    /**
     * @param User $record
     *
     * @return JsonResponse
     */
    public function show(User $record)
    {
        return $this->showOne($record);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $inputs = $request->all();

        try {
            $inputs['slug'] = Str::slug($inputs['name'], '-');

            //Policy validated so it is available
            $inputs['password'] = bcrypt($inputs['password']);

            $this->validator->with($inputs)->passesOrFail(ValidatorInterface::RULE_CREATE);

            $record = $this->repository->create($inputs);

            return response()->json($record, 201);
        } catch (ValidatorException $e) {
            return $this->errorResponse($e->getMessageBag(), 409);
        }
    }
}
