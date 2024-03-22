<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Client; // Import the Client model
use App\Models\Employee;

class ClientMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Check if the user is authenticated and if they have a corresponding record in the "clients" table
        if (!$request->user() || Client::where('user_id', $request->user()->id)->exists()||Employee::where('user_id', $request->user()->id)->exists()) {
            return redirect()->route('login');
        }

        return $next($request);
    }
}
