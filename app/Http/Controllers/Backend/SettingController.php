<?php

namespace App\Http\Controllers\Backend;

use App\Contracts\Repositories\SettingRepository;
use App\Models\Setting;
use App\Validators\SettingValidator;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;

class SettingController extends BackendBaseController
{
    use ValidatesRequests;

    /**
     * @var SettingRepository
     */
    protected  $repository;

    /**
     * @var \App\Validators\SettingValidator
     */
    protected $validator;

    /**
     * ProfileController constructor.
     *
     * @param \App\Contracts\Repositories\SettingRepository $repository
     * @param \App\Validators\SettingValidator $validator
     */
    public function __construct(SettingRepository $repository, SettingValidator $validator)
    {
        $this->repository = $repository;
        $this->validator = $validator;

        $this->authorizeResource(Setting::class, 'setting');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $records = $this->repository->orderBy('created_at','desc')->all();

        $languageCode =  $this->repository->findByField('attribute_key', 'language_code')->pluck('attribute_value')->first();
        $title = $this->repository->findByField('attribute_key', 'title')->pluck('attribute_value')->first();
        $slogan = $this->repository->findByField('attribute_key', 'slogan')->pluck('attribute_value')->first();
        $description = $this->repository->findByField('attribute_key', 'description')->pluck('attribute_value')->first();
        $keywords = $this->repository->findByField('attribute_key', 'keywords')->pluck('attribute_value')->first();
        $registrationType = $this->repository->findByField('attribute_key', 'registration_type')->pluck('attribute_value')->first();
        $timezone = $this->repository->findByField('attribute_key', 'timezone')->pluck('attribute_value')->first();
        $url = $this->repository->findByField('attribute_key', 'url')->pluck('attribute_value')->first();
        $roles = Role::all()->pluck('name', 'id');
        
        $userDefaultRole = Setting::where('attribute_key', 'user_default_role')->first();
        $userDefaultRole = $userDefaultRole->attribute_value;


        $registrationTypes = [];
        foreach (Setting::$registrationTypes as $regType){
            array_push($registrationTypes, $regType['name']);
        }


        return view('backend.views.setting.index',compact([
            'records',
            'languageCode',
            'title',
            'slogan',
            'description',
            'keywords',
            'registrationTypes',
            'registrationType',
            'timezone',
            'url',
            'roles',
            'userDefaultRole',
        ]));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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

        if (!empty($inputs['title']) || $inputs['title'] == null){
            $record = $this->repository->findByField('attribute_key', 'title')->first();
            $this->repository->update( ['attribute_value' => $inputs['title']], $record->id);
        }

        if (!empty($inputs['slogan']) || $inputs['slogan'] == null){
            $record = $this->repository->findByField('attribute_key', 'slogan')->first();
            $this->repository->update(['attribute_value' => $inputs['slogan']], $record->id);
        }

        if (!empty($inputs['description']) || $inputs['description'] == null){
            $record = $this->repository->findByField('attribute_key', 'description')->first();
            $this->repository->update(['attribute_value' => $inputs['description']], $record->id);
        }

        if (!empty($inputs['keywords']) || $inputs['keywords'] == null){
            $record = $this->repository->findByField('attribute_key', 'keywords')->first();
            $this->repository->update(['attribute_value' => $inputs['keywords']], $record->id);
        }

        if (!empty($inputs['url']) || $inputs['url'] == null){
            $record = $this->repository->findByField('attribute_key', 'url')->first();
            $this->repository->update(['attribute_value' => $inputs['url']], $record->id);
        }

        if (!empty($inputs['registration_type']) || $inputs['registration_type'] == null){
            $record = $this->repository->findByField('attribute_key', 'registration_type')->first();
            $this->repository->update(['attribute_value' => $inputs['registration_type']], $record->id);
        }

        if (!empty($inputs['user_default_role']) || $inputs['user_default_role'] == null){
            $record = $this->repository->findByField('attribute_key', 'user_default_role')->first();
            $this->repository->update(['attribute_value' => $inputs['user_default_role']], $record->id);
        }

        return redirect()->to(route('setting.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $record
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($record)
    {
        dd($record);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
