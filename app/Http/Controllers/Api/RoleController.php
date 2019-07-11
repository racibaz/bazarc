<?php

namespace App\Http\Controllers\Api;

use App\Contracts\Repositories\RoleRepository as Repository;
use App\Models\Role;
use App\Validators\RoleValidator;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;

class RoleController extends ApiController
{
    /**
     * @var $repository
     */
    private $repository;

    /**
     * @var RoleValidator
     */
    private $validator;

    /**
     * RoleController constructor.
     *
     * @param Repository $repository
     * @param \App\Validators\RoleValidator $validator
     *
     * @internal param \App\Http\Controllers\Api\User\Repo $repo
     */
    public function __construct(Repository $repository, RoleValidator $validator)
    {
        parent::__construct();

        $this->repository = $repository;

        $this->validator = $validator;
    }

    /**
     * role list
     * @return mixed
     */
    public function index()
    {
        $records = $this->repository->all();

        return $this->showAll($records);
    }

    /**
     * @param \App\Models\Role $record
     *
     * @return JsonResponse
     */
    public function show(Role $record)
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
            $this->validator->with($inputs)->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $record = $this->repository->create($inputs);

            return response()->json($record, 201);

        }catch(ValidatorException $e){

            return Response::json([
                    'error' => true,
                    'message' => $e->getMessageBag()
                ]
            );
        }
    }
}
