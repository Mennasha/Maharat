<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckInstalled {
    public function handle(Request $request, Closure $next) {
        $installed = file_exists(storage_path('installed'));

        // If not installed and not on /install routes, redirect to installer
        if (!$installed && !$request->is('install*')) {
            return redirect('/install');
        }

        // If already installed and trying to access /install routes, redirect home
        if ($installed && $request->is('install*')) {
            return redirect('/');
        }

        return $next($request);
    }
}
