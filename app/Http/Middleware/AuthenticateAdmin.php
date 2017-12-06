<?php

namespace App\Http\Middleware;

use Closure;
use Route, URL, Auth;

class AuthenticateAdmin
{

    protected $except = [
        'admin/index',
    ];

    /**
     * Handle an incoming request.
     * @param $request
     * @param Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::guard('admin')->user()->id === 1) {
            return $next($request);
        }

        $previousUrl = URL::previous();
        $routeName = starts_with(Route::currentRouteName(), 'admin.') ? Route::currentRouteName() : 'admin.' . Route::currentRouteName();
//        \Debugbar::info($routeName);
//        \Debugbar::info(\Gate::forUser(auth('admin')->user())->check($routeName));
        if (!\Gate::forUser(auth('admin')->user())->check($routeName)) {

            if ($request->ajax() && ($request->getMethod() != 'GET')) {

                return response()->json([
                    'status' => -1,
                    'code'   => 403,
                    'msg'    => '您沒有權限操作',
                    'Message'=>'您沒有權限操作',
                ],403);
            } else {
                return response()->view('admin.errors.403', compact('previousUrl'));
            }
        }

        return $next($request);
    }
}
