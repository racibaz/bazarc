<?php

namespace App\Http\Controllers\Backend;

use App\Contracts\Repositories\UserRepository;
use App\Models\User;
use App\Validators\UserValidator;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Str;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use Yajra\DataTables\Facades\DataTables;

class UserController extends BackendBaseController
{
    use ValidatesRequests;

    /**
     * @var UserRepository
     */
    protected  $repository;

    /**
     * @var UserRepository
     */
    protected $validator;

    /**
     * DashboardController constructor.
     *
     * @param UserRepository $repository
     * @param \App\Validators\UserValidator $validator
     */
    public function __construct(UserRepository $repository, UserValidator $validator)
    {
//        parent::__construct();
//        $this->middleware('auth');
        //$request->getUri()

        $this->repository = $repository;
        $this->validator = $validator;

        $this->authorizeResource(User::class, 'user');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = $this->repository->orderBy('created_at','desc')->all();
        return view('backend.views.user.index',compact(['users']));
    }

    /**
     * Process datatables ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function anyData()
    {
        return Datatables::of(User::query())->make(true);
    }

    /**
     * todo instance repo dan alınmalı..
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $record = new User();
        return view('backend.views.user._form',compact(['record']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $inputs = $request->all();

        try
        {
            $inputs['slug'] = Str::slug($inputs['name'], '-');

            //Policy validated so it is available
            $inputs['password'] = bcrypt($inputs['password']);

            $this->validator->with( $inputs )->passesOrFail( ValidatorInterface::RULE_UPDATE );

            $this->repository->create($inputs);

            return redirect()->to(route('user.index'));

        }catch (ValidatorException $e){

            return Response::json([
                'error'   =>true,
                'message' =>$e->getMessageBag()
            ]);
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
        return view('backend.views.user.show',compact(['record']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($record)
    {
        return view('backend.views.user._form',compact(['record']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param $record
     *
     * @return \Illuminate\Http\JsonResponse
     * @internal param int $id
     *
     */
    public function update(Request $request, $record)
    {
        $inputs = $request->all();

        try
        {
            $inputs['slug'] = Str::slug($inputs['name'], '-');

            if(!empty($inputs['password'])){
                $inputs['password'] = bcrypt($inputs['password']);
            }else{
                unset($inputs['password']);
            }

            $this->validator->with( $inputs )->setId($record->id)->passesOrFail( ValidatorInterface::RULE_UPDATE );

            $this->repository->update($inputs, $record->id);

            return redirect()->to(route('user.index'));

        }catch (ValidatorException $e){

            return Response::json([
                'error'   =>true,
                'message' =>$e->getMessageBag()
            ]);
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
        return redirect()->to(route('user.index'));
    }
}
