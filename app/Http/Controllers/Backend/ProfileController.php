<?php

namespace App\Http\Controllers\Backend;

use App\Models\Profile;
use App\Models\ProfileRepository;
use App\Validators\ProfileValidator;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Str;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;


class ProfileController extends BackendBaseController
{
    use ValidatesRequests;

    /**
     * @var ProfileRepository
     */
    protected  $repository;

    /**
     * @var \App\Validators\ProfileValidator
     */
    protected $validator;

    /**
     * ProfileController constructor.
     *
     * @param ProfileRepository $repository
     * @param \App\Validators\ProfileValidator $validator
     */
    public function __construct(ProfileRepository $repository, ProfileValidator $validator)
    {
        $this->repository = $repository;
        $this->validator = $validator;

        $this->authorizeResource(Profile::class, 'profile');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($record)
    {
        return view('backend.views.profile.show',compact(['record']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $record
     *
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function edit($record)
    {
        return view('backend.views.profile._form',compact(['record']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\JsonResponse
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

            return redirect()->to(route('profile.index'));

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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
