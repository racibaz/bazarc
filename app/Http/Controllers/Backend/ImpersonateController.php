<?php

namespace App\Http\Controllers\Backend;

use App\Contracts\Repositories\UserRepository;
use App\Models\User;
use App\Validators\UserValidator;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ImpersonateController extends BackendBaseController
{
//    use ValidatesRequests;
//
//    /**
//     * @var UserRepository
//     */
//    protected  $repository;
//
//    /**
//     * @var * @var \App\Validators\UserValidator
//     */
//    protected $validator;
//
//    /**
//     * DashboardController constructor.
//     *
//     * @param UserRepository $repository
//     * @param \App\Validators\UserValidator $validator
//     */
//    public function __construct(UserRepository $repository, UserValidator $validator)
//    {
//        $this->repository = $repository;
//        $this->validator = $validator;
//    }


    public function index()
    {
        return  view('backend.views.impersonate.index');
    }


    public function impersonate(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email'
        ]);

        $user = User::where('email', $request->email)->first();

        session()->put('impersonate_by', auth()->id());

        Auth::login($user);

        return redirect(route('dashboard'));
    }

    public function stop()
    {
        Auth::loginUsingId(session('impersonate_by'));

        session()->forget('impersonate_by');

        return redirect(route('home'));
    }
}
