<?php

namespace App\Http\Controllers\Web\V1\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    /**
     * Show admin login page.
     */
    public function index()
    {
        return view('admin.auth.login');
    }

    /**
     * Handle admin login.
     */
    public function loginSubmit(Request $request)
    {
        $credentials = $request->validate([
            'email' => [
                'required',
                'email',
            ],
            'password' => [
                'required',
            ],
        ], [
            'password' => 'Email or Password do not match!',
        ]);

        $user = User::where('email', $credentials['email'])
            ->where('user_type', User::ADMIN)
            ->first();

        if (!$user) {
            return back()
                ->withInput()
                ->with('error', 'Entered email id not found in the system!');
        }

        if (!password_verify($credentials['password'], $user->password)) {
            return back()
                ->withInput()
                ->with('error', 'Invalid password.');
        }

        $this->setUserSession($user);

        return redirect()
            ->route('admin.dashboard.index')
            ->with('success', 'Successfully Login to Admin Dashboard.');
    }

    /**
     * Admin logout.
     */
    public function logout()
    {
        session()->invalidate();
        session()->regenerateToken();

        return redirect()->route('admin.login');
    }

    /**
     * Set logged-in user session.
     */
    private function setUserSession(User $user): void
    {
        session([
            'id' => $user->id,
            'firstname' => $user->user_name,
            'email' => $user->email,
            'isLoggedIn' => true,
            'user_type' => $user->user_type,
            'userTypeUrl' => 'admin',
        ]);
    }
}