<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class BackendBaseController extends Controller
{

    use DispatchesJobs, ValidatesRequests;

    use AuthorizesRequests {
        resourceAbilityMap as protected resourceAbilityMapTrait;
    }

    /**
     * Controller constructor.
     *
     * Set permisson_check method
     *
     */
    public function __construct()
    {
        $this->middleware(function ($request, $next) {

            $this->checkPermissionOnCurrentRoute();

            return $next($request);
        });
    }

    /**
     * Get the map of resource methods to ability names.
     *
     * @example https://github.com/laravel/ideas/issues/772
     * @return array
     */
    protected function resourceAbilityMap()
    {
        // Map the "index" ability to the "index" function in our policies
        return array_merge($this->resourceAbilityMapTrait(), ['index' => 'index']);
    }



    /**
     * Check the user permissions in current route
     * @return bool
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function checkPermissionOnCurrentRoute()
    {
        $route = Route::getCurrentRoute()->getAction();

        $routePathParts = explode('@', $route['controller']);

        $controllerPathParts = explode('\\', $routePathParts[0]);

        $partCount = count($controllerPathParts);

        $controllerName = $controllerPathParts[$partCount - 1];

        $methodName = $routePathParts[1];

        $classModelName = strtolower(substr($controllerName, 0, -10));

        if (!Auth::user()->can($methodName . '-' . $classModelName)) {
//        if (!Auth::user()->can($methodName . '-' . $classModelName)) {
            //Log::warning('Yetkisiz Alana Girmeye Çalışıldı. ' . 'Kişi : ' . Auth::user()->name . '  IP :' . Auth::user()->getUserIp());
            throw new AuthorizationException('Unauthorized action.');
        }

        return true;
    }
}
