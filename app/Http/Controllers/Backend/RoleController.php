<?php

namespace App\Http\Controllers\Backend;

use App\Contracts\Repositories\RoleRepository as Repository;
use App\Models\Role;
use App\Validators\RoleValidator;
use Exception;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;

class RoleController extends BackendBaseController
{
    use ValidatesRequests;

    /**
     * @var RoleRepository
     */
    protected $repository;

    /**
     * @var * @var \App\Validators\RoleValidator
     */
    protected $validator;

    /**
     * DashboardController constructor.
     *
     * @param \App\Contracts\Repositories\RoleRepository $repository
     * @param RoleValidator $validator
     */
    public function __construct(Repository $repository, RoleValidator $validator)
    {
        $this->repository = $repository;
        $this->validator = $validator;

        $this->authorizeResource(Role::class, 'role');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * @throws Exception
     */
    public function index()
    {
        $roles = $this->repository->orderBy('created_at', 'desc')->all();

        if (\request()->ajax()) {
            return $this->datatableData($roles);
        }
        return view('backend.role.index', compact(['roles']));
    }

    /**
     * todo instance repo dan alınmalı..
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $record = new Role();
        return view('backend.role._form', compact(['record']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $inputs = $request->all();

        try {
            $this->validator->with($inputs)->passesOrFail(ValidatorInterface::RULE_CREATE);

            $this->repository->create($inputs);

            return redirect()->to(route('role.index'));
        } catch (ValidatorException $e) {
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
        return view('backend.role.show', compact(['record']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($record)
    {
        return view('backend.role._form', compact(['record']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param $record
     *
     * @return JsonResponse
     * @internal param int $id
     */
    public function update(Request $request, $record)
    {
        $inputs = $request->all();

        try {
            $this->validator->with($inputs)->setId($record->id)->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $this->repository->update($inputs, $record->id);

            return redirect()->to(route('role.index'));
        } catch (ValidatorException $e) {
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
        return redirect()->to(route('role.index'));
    }
}
