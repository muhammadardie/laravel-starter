<?php

namespace App\Http\Middleware;

use Closure;
use App\Traits\MenuPermissionTrait, PermissionTrait;

class CheckRoute
{
    use MenuPermissionTrait;

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // don't check permission on ajax request or user not logged in or menu dashboard
        if($request->ajax()) {
            return $next($request);
        }

        // get available permission on logged in user
        $permissions = $this->availablePermission();
        // get available menu access on logged in user
        $menuAccess  = \Auth::user()->role->menu;
        
        // loop menu access to check if accessed route/url available in menu
        foreach ($menuAccess as $key => $value) {

            if($value->route === $this->currentRoute('route') ) {

                if(in_array($this->currentRoute('action'), $permissions)) {
                    return $next($request);
                }
            }

        }

        abort(403);
    }
}
