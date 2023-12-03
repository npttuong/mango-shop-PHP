<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleName
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
    if (Auth::check()) {
      if (Auth::user()->role_name == 'admin') {
        return $next($request);
      } else if (Auth::user()->role_name == 'user') {
        return redirect('/user-profile')->with('error', 'Bạn không có quyền admin.');
      }
    } else {
      return redirect('/login')->with('error', 'Bạn cần phải đăng nhập trước.');
    }

    return $next($request);
  }
}