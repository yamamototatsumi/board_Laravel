<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use App\Http\Controllers\ArticlesController;
use App\Http\Controllers\CommentsController;
use App\Models\Article;

class Identification 
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
      $data=Article::identification($request->id);
      if (!Auth::user()->user_id === $data) {
        return redirect(RouteServiceProvider::ERROR);
      }
        return $next($request);
    }
}
