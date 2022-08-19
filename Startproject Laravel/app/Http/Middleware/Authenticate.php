<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Session;
use Closure;

class Authenticate extends Middleware
{
	/**
	 * Get the path the user should be redirected to when they are not authenticated.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return string|null
	 */
	public function handle($request, Closure $next, ...$guards)
	{
		$path = $request->path();
		if (Session::get('start_project_adminuser') && ($path == 'admin/login' || $path == 'admin')) {
			return redirect('admin/dashboard');
		} else if (!Session::get('start_project_adminuser') && $path != 'admin/login' && $path != 'admin') {
			return redirect('admin/login');
		} else if ((Session::get('start_project_admintype') == "staff") && ($path == 'admin/list-admin' || $path == 'admin/add-admin')) {
			return redirect('admin/dashboard');
		}
		else if ((Session::get('start_project_admintype') == "staff") && ($path == 'admin/list-menu' || $path == 'admin/add-menu')) {
			return redirect('admin/dashboard');
		}
		return $next($request);
	}
}
