<?php

namespace App\Http\Controllers\Backend;

use App\Contracts\Repositories\PermissionRepository as Repository;
use App\Models\Permission;
use App\Validators\PermissionValidator;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;

class PermissionController extends BackendBaseController
{
    use ValidatesRequests;

    /**
     * @var PermissionRepository
     */
    protected $repository;

    /**
     * @var * @var \App\Validators\PermissionValidator
     */
    protected $validator;

    /**
     * DashboardController constructor.
     *
     * @param  \App\Contracts\Repositories\PermissionRepository  $repository
     * @param  PermissionValidator  $validator
     */
    public function __construct(Repository $repository, PermissionValidator $validator)
    {
        $this->repository = $repository;
        $this->validator = $validator;

        $this->authorizeResource(Permission::class, 'permission');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function index()
    {
        $records = $this->repository->orderBy('created_at', 'desc')->all();

        if (\request()->ajax()) {
            return $this->datatableData($records);
        }

        return view('backend.permission.index', compact(['records']));
    }

    /**
     * todo instance repo dan alınmalı..
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $record = new Permission();
        return view('backend.permission._form', compact(['record']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $inputs = $request->all();

        try {
            $this->validator->with($inputs)->passesOrFail(ValidatorInterface::RULE_CREATE);

            $this->repository->create($inputs);

            return redirect()->to(route('permission.index'));
        }catch (ValidatorException $e){
            return Response::json([
                    'error' => true,
                    'message' => $e->getMessageBag()
                ]
            );
        }
    }

    /**
     * Display the specified resource.
     *
     * @param $record
     *
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function show($record)
    {
        return view('backend.permission.show', compact(['record']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($record)
    {
        return view('backend.permission._form', compact(['record']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param $record
     *
     * @return JsonResponse
     * @internal param int $id
     *
     */
    public function update(Request $request, $record)
    {
        $inputs = $request->all();

        try {
            $this->validator->with($inputs)->setId($record->id)->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $this->repository->update($inputs, $record->id);

            return redirect()->to(route('permission.index'));

        }catch (ValidatorException $e){
            return Response::json([
                    'error' => true,
                    'message' => $e->getMessageBag()
                ]
            );
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $record
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($record)
    {
        $this->repository->delete($record->id);
        return redirect()->to(route('permission.index'));
    }
}
