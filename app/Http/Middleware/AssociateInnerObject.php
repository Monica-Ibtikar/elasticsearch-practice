<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AssociateInnerObject
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @param $key
     * @param $repo
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $key, $repo)
    {
        if($request->input($key)) {
            $id = $request->input($key);
            $repo = resolve("$repo");
            $innerObj = $repo->find($id);
            $request->replace([$key => array_merge(["id" => $id], $innerObj)]);
        }
        return $next($request);
    }
}
