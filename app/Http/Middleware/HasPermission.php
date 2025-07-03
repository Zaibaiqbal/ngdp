<?php

namespace App\Http\Middleware;

use Closure;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Traits\HasPermissions;

class HasPermission 
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next,...$permissions)
    {
        // FOR GUEST USER
        if(!isset($request->user()->id))
        {
            return $next($request);
        }
        foreach($permissions as $permission){

       $permission = explode('|',$permission);



            if (!$request->user()->hasAnyPermission($permission)){
               
               return abort('403');                       
            }
            break;
        }    
        return $next($request);
    }
}
