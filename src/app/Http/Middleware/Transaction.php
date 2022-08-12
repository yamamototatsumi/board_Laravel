<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
USE Illuminate\Support\Facades\DB;

class Transaction
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
      DB::beginTransaction();
      $response = $next($request);
      if ($response->exception) {
          DB::rollBack();
      } else {
          DB::commit();
      }
      return $response;
    }
}
