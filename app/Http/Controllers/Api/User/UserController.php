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
use Intervention\Image\Facades\Image;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;

class UserController extends ApiController
{
    /**
     * @var $repository
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
     * user list
     * @return mixed
     */
    public function index()
    {
        $users = $this->repository->all();

        return $this->showAll($users);
    }

    /**
     * @return JsonResponse
     */
    public function profile()
    {
        return User::find(1);

//        $record = auth('api')->user();
//        return $this->showOne($record);
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

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param $record
     *
     * @return JsonResponse
     * @internal param int $id
     *
     */
    public function profileUpdate(Request $request)
    {
        //todo auth('api')->user();
        $record = User::find(1);
        $inputs = $request->all();

        try {
            //todo it should be function
            $inputs['slug'] = Str::slug($inputs['name'], '-');

            //todo it should be function
            if (!empty($inputs['password'])) {
                $inputs['password'] = bcrypt($inputs['password']);
            } else {
                unset($inputs['password']);
            }

            $this->validator->with($inputs)->setId($record->id)->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $currentPhoto = $record->photo;
            //todo dd(Theme::getCurrent());
            if ($request->photo != $currentPhoto) {
                //todo it should be function
                $name = time() . '.' . explode('/',
                        explode(':', substr($request->photo, 0, strpos($request->photo, ';')))[1]
                    )[1];

                Image::make($request->photo)->save(public_path('img/profile/') . $name);
                $request->merge(['photo' => $name]);
                $inputs['photo'] = $name;
                $userPhoto = public_path('img/profile/') . $currentPhoto;
                if (file_exists($userPhoto)) {
                    @unlink($userPhoto);
                }
            }

            $this->repository->update($inputs, $record->id);
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
     *
     * @return JsonResponse
     * @internal param int $id
     *
     */
    public function update(Request $request, $record)
    {
        $inputs = $request->all();

        try {
            $inputs['slug'] = Str::slug($inputs['name'], '-');

            if (!empty($inputs['password'])) {
                $inputs['password'] = bcrypt($inputs['password']);
            } else {
                unset($inputs['password']);
            }
            $this->validator->with($inputs)->setId($record->id)->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $this->repository->update($inputs, $record->id);

            return response()->json($record, 201);

        } catch (ValidatorException $e) {
            return $this->errorResponse($e->getMessageBag(), 409);
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
        return $this->showOne($record);
    }
}
