<?php

namespace App\Http\Controllers\Web\V1\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Utils\FnUtils;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserRegisterController extends Controller
{

    public function create()
    {
        $data = [
            'title' => 'User Registration Form',
        ];

        $data['statesArrayData'] = $this->formDetails()['statesArrayData'];

        $data['userTypeUrl'] = FnUtils::getDetailsByUserType()['userTypeUrl'];

        return view('users.auth.register', $data);
    }

    /**
     * Get registration form details.
     */
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

    /**
     * Get user type URL.
     */
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

    public function add(Request $request)
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
}