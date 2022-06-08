<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class FileSystemMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
      //  dd($request->user());
        // if (auth()->check())
        // {
        //     $uuid = Auth()->user()->empresa->uuid;

        //     config()->set(
        //         'filesystems.disks.empresa.root',
        //         config('filesystems.disks.empresa.root') . "/{$uuid}"
        //     );
        // }

        return $next($request);
    }
}
