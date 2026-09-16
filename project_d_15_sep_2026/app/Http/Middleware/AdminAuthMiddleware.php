<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminAuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if user is logged in
        if (!session('isLoggedIn')) {
            return redirect()->route('admin.login');
        }

        // Get logged-in user's type
        $userType = (int) session('user_type');

        // Allow only Super Admin, Admin, and Sub Admin
        if (!in_array($userType, [
            User::SUPER_ADMIN,
            User::ADMIN,
            User::SUB_ADMIN,
        ], true)) {
            return redirect()->route('admin.login');
        }

        return $next($request);
    }
}
