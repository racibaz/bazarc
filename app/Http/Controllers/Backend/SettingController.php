<?php

namespace App\Http\Controllers\Backend;

use App\Contracts\Repositories\SettingRepository;
use App\Models\Setting;
use App\Models\User;
use App\Validators\SettingValidator;
use DateTimeZone;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Spatie\Permission\Models\Role;

class SettingController extends BackendBaseController
{
    use ValidatesRequests;

    /**
     * @var SettingRepository
     */
    protected $repository;

    /**
     * @var SettingValidator
     */
    protected $validator;

    /**
     * ProfileController constructor.
     *
     * @param SettingRepository $repository
     * @param SettingValidator $validator
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
     * @return View
     */
    public function index()
    {
        $records = $this->repository->orderBy('created_at', 'desc')->all();

        $languageCode = $this->repository->findByField('attribute_key', 'language_code')->pluck('attribute_value'
        )->first();
        $title = $this->repository->findByField('attribute_key', 'title')->pluck('attribute_value')->first();
        $slogan = $this->repository->findByField('attribute_key', 'slogan')->pluck('attribute_value')->first();
        $description = $this->repository->findByField('attribute_key', 'description')->pluck('attribute_value')->first(
        );
        $keywords = $this->repository->findByField('attribute_key', 'keywords')->pluck('attribute_value')->first();
        $registrationType = $this->repository->findByField('attribute_key', 'registration_type'
        )->pluck('attribute_value')->first();
        $defaultTimezone = $this->repository->findByField('attribute_key', 'timezone')->pluck('attribute_value')->first(
        );
        $url = $this->repository->findByField('attribute_key', 'url')->pluck('attribute_value')->first();
        $roles = Role::all()->pluck('name', 'id');

        $timezoneList = [];
        //SelectBox içerisinde value değerinin seçilebilmesi için key yerine value değerini atıyoruz.
        foreach (DateTimeZone::listIdentifiers() as $key => $value) {
            $timezoneList[$value] = $value;
        }

        $userDefaultRole = Setting::where('attribute_key', 'user_default_role')->first();
        $userDefaultRole = $userDefaultRole->attribute_value;

        $userDefaultStatus = Setting::where('attribute_key', 'user_default_status')->first();
        $userDefaultStatus = $userDefaultStatus->attribute_value;

        //todo we should write function for it
        $statuses = [];
        foreach (User::$statuses as $index => $status) {
            $statuses[$status['number']] = $status['name'];
        }
        $statuses = collect($statuses);

        //todo we should write function for it
        $registrationTypes = [];
        foreach (Setting::$registrationTypes as $index => $regType) {
            $registrationTypes[$regType['number']] = $regType['name'];
        }
        $registrationTypes = collect($registrationTypes);

        return view('backend.setting.index', compact([
            'records',
            'languageCode',
            'title',
            'slogan',
            'description',
            'keywords',
            'registrationTypes',
            'registrationType',
            'defaultTimezone',
            'timezoneList',
            'url',
            'roles',
            'userDefaultRole',
            'statuses',
            'userDefaultStatus'
        ]
        )
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $inputs = $request->all();

        if (!empty($inputs['title']) || $inputs['title'] == null) {
            $record = $this->repository->findByField('attribute_key', 'title')->first();
            $this->repository->update(['attribute_value' => $inputs['title']], $record->id);
        }

        if (!empty($inputs['slogan']) || $inputs['slogan'] == null) {
            $record = $this->repository->findByField('attribute_key', 'slogan')->first();
            $this->repository->update(['attribute_value' => $inputs['slogan']], $record->id);
        }

        if (!empty($inputs['description']) || $inputs['description'] == null) {
            $record = $this->repository->findByField('attribute_key', 'description')->first();
            $this->repository->update(['attribute_value' => $inputs['description']], $record->id);
        }

        if (!empty($inputs['keywords']) || $inputs['keywords'] == null) {
            $record = $this->repository->findByField('attribute_key', 'keywords')->first();
            $this->repository->update(['attribute_value' => $inputs['keywords']], $record->id);
        }

        if (!empty($inputs['url']) || $inputs['url'] == null) {
            $record = $this->repository->findByField('attribute_key', 'url')->first();
            $this->repository->update(['attribute_value' => $inputs['url']], $record->id);
        }

        if (!empty($inputs['timezone']) || $inputs['timezone'] == null) {
            $record = $this->repository->findByField('attribute_key', 'timezone')->first();
            $this->repository->update(['attribute_value' => $inputs['timezone']], $record->id);
        }

        if (!empty($inputs['registration_type']) || $inputs['registration_type'] == null) {
            $record = $this->repository->findByField('attribute_key', 'registration_type')->first();
            $this->repository->update(['attribute_value' => $inputs['registration_type']], $record->id);
        }

        if (!empty($inputs['user_default_role']) || $inputs['user_default_role'] == null) {

            $record = $this->repository->findByField('attribute_key', 'user_default_role')->first();
            $this->repository->update(['attribute_value' => $inputs['user_default_role']], $record->id);
        }

        if (!empty($inputs['user_default_status']) || $inputs['user_default_status'] == null) {

            $record = $this->repository->findByField('attribute_key', 'user_default_status')->first();
            $this->repository->update(['attribute_value' => $inputs['user_default_status']], $record->id);
        }


        return redirect()->to(route('setting.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
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
     * @return Response
     */
    public function edit($record)
    {
        dd($record);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
