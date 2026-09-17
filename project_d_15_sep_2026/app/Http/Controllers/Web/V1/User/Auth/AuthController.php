<?php

namespace App\Http\Controllers\Web\V1\User\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{

    public function login()
    {
        if (session('isLoggedIn')) {
            return redirect()->route('users.dashboard');
        }

        return view('users.auth.login', [
            'title' => 'User Login',
        ]);
    }
    private function formDetails(): array
    {
        $countryID = 101;

        $statesArrayData = DB::table('states')
            ->where('country_id', $countryID)
            ->get()
            ->toArray();

        return [
            'countryID' => $countryID,
            'statesArrayData' => $statesArrayData,
        ];
    }

    public function register()
    {
        $statesArrayData = $this->formDetails()['statesArrayData'];

        $userTypeUrl = 'users';
        if (session('isLoggedIn')) {
            return redirect()->route('users.dashboard');
        }

        return view('users.auth.register', [
            'title' => 'User register',
            'userTypeUrl' => $userTypeUrl,
            'statesArrayData' => $statesArrayData,
        ]);
    }


    public function loginSubmit(Request $request)
    {
        $validated = $request->validate([
            'email' => [
                'required',
                'email',
            ],

            'password' => [
                'required',
            ],
        ], [
            'password.required' => 'Email or Password do not match!',
        ]);

        $user = User::query()
            ->where('email', $validated['email'])
            ->where('user_type', User::USER)
            ->first();

        if (!$user) {
            return back()
                ->withInput($request->only('email'))
                ->with('error', 'Entered email id not found in the system!');
        }

        if (!password_verify($validated['password'], $user->password)) {
            return back()
                ->withInput($request->only('email'))
                ->with('error', 'Email or Password do not match!');
        }

        $this->setUserSession($user);

        return redirect()->route('users.dashboard');
    }

    public function registerSubmit(Request $request)
    {
        $data = [
            'title' => 'User Registration',
        ];

        $data['statesArrayData'] = $this->formDetails()['statesArrayData'];

        $userDataArray = $this->makeUsersPayload($request);

        $user = User::create($userDataArray);

        $userId = null;
        if ($user) {
            $userId = $user->id;

            if ((int) session('user_type') === User::ADMIN) {
                return redirect()
                    ->route('admin.dashboard.index')
                    ->with('success', 'User created successfully.');
            }

            return redirect()
                ->route('users.login')
                ->with('success', 'Account created successfully. Please login.');
        }

        $data['userTypeUrl'] = $this->getDetailsByUserType($userId)['userTypeUrl'];

        return view('sign_up', $data);
    }

    public static function getDetailsByUserType($userId = null): array
    {
        $data = [
            'userTypeUrl' => 'users',
            'headerName' => 'Update User Data',
        ];

        $currentUserId = (int) session('id');
        $userType = (int) session('user_type');
        $userId = (int) $userId;

        if ($userType === User::ADMIN) {

            if ($userId === $currentUserId) {
                $data['headerName'] = 'Update Admin Data';
                $data['userTypeUrl'] = 'admin';

                return [
                    'userTypeUrl' => 'admin',
                ];
            }

            $data['headerName'] = 'Update User Data';
            $data['userTypeUrl'] = 'admin/users';

            return [
                'userTypeUrl' => 'admin/users',
            ];
        }

        if (
            $userType === User::USER &&
            $userId === $currentUserId
        ) {
            $data['headerName'] = 'Update Data';
            $data['userTypeUrl'] = 'users';

            return [
                'userTypeUrl' => 'users',
            ];
        }

        return $data;
    }

     /**
     * Create user payload.
     */
    private function makeUsersPayload(Request $request): array
    {
        $createdBy = session('id') ?? null;

        $firstName = $request->input('firstname');
        $lastName = $request->input('lastname');

        $userName = $firstName . ' ' . $lastName;

        return [
            'first_name' => $firstName,
            'last_name' => $lastName,
            'user_name' => $userName,
            'phone' => $request->input('phone'),
            'email' => $request->input('email'),
            'password' => $request->input('password'),
            'temp_passowrd' => $request->input('password'),
            'gender' => $request->input('gender'),
            'state' => $request->input('state'),
            'user_type' => User::USER,
            'created_by' => $createdBy,
        ];
    }

    private function setUserSession(User $user): void
    {
        session([
            'id' => $user->id,
            'firstname' => $user->user_name,
            'email' => $user->email,
            'isLoggedIn' => true,
            'user_type' => $user->user_type,
            'userTypeUrl' => 'users',
        ]);
    }

    public function logout(Request $request)
    {
        session()->invalidate();
        session()->regenerateToken();

        return redirect()->route('users.login');
    }
}