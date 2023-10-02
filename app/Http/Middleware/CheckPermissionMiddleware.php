<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class CheckPermissionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $permission)
    {
        if ( auth()->user()->hasRole('super-admin')) {
            return $next($request);
        }

        $canProceed = true;
        if ($canProceed) {
            $permissionsByRoles = auth()
                ->user()
                ->getPermissionsViaRoles()
                ->pluck('name');
            $permissionsByRolesArray = $permissionsByRoles->toArray();
            $canProceed = in_array($permission, $permissionsByRolesArray);
        }

        if (!$canProceed) {
            return redirect()->back()
                ->with('message', __('admin.AccessDenied'));
        }

        return $next($request);
    }
}