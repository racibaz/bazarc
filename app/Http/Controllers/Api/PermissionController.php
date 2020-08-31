<?php

namespace App\Http\Controllers\Api;

use App\Contracts\Repositories\PermissionRepository as Repository;
use App\Validators\PermissionValidator;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;

class PermissionController extends ApiController
{
    /**
     * @var
     */
    private $repository;

    /**
     * @var PermissionValidator
     */
    private $validator;

    /**
     * PermissionController constructor.
     *
     * @param Repository $repository
     * @param PermissionValidator $validator
     */
    public function __construct(Repository $repository, PermissionValidator $validator)
    {
        parent::__construct();

        $this->repository = $repository;

        $this->validator = $validator;
    }

    /**
     * permission list.
     * @return mixed
     */
    public function index()
    {
        $records = $this->repository->all();

        return $this->showAll($records);
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
