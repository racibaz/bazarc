<?php

namespace App\Http\Controllers\Api;

use App\Contracts\Repositories\RoleRepository as Repository;
use App\Models\Role;
use App\Validators\RoleValidator;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;

class RoleController extends ApiController
{
    /**
     * @var
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
     * @param RoleValidator $validator
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
     * role list.
     * @return mixed
     */
    public function index()
    {
        $records = $this->repository->all();

        return $this->showAll($records);
    }

    /**
     * @param Role $record
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
     * @return JsonResponse|Response
     */
    public function store(Request $request)
    {
        $inputs = $request->all();

        try {
            $this->validator->with($inputs)->passesOrFail(ValidatorInterface::RULE_CREATE);

            $record = $this->repository->create($inputs);

            return response()->json($record, 201);
        } catch (ValidatorException $e) {
            return $this->errorResponse($e->getMessageBag(), 409);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param $record
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $record)
    {
        $inputs = $request->all();

        try {
            $this->validator->with($inputs)->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $this->repository->update($request->all(), $record->id);

            return $this->showMessage('Updated the record info');
        } catch (ValidatorException $e) {
            return $this->errorResponse($e->getMessageBag(), 409);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $record
     * @return array
     */
    public function destroy($record)
    {
        $this->repository->delete($record->id);

        return $this->showMessage('Updated the record info');
    }
}
