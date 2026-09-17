<?php

namespace App\Http\Controllers\Web\V1\Admin\Users;

use App\Http\Controllers\Controller;
use App\Models\State;
use App\Models\User;
use App\Utils\FnUtils;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function create()
    {
        // Show user registration form
        $data = [
            'title' => 'User Registration Form',
        ];

        $data['statesArrayData'] = State::getDetailsByCountryId(101);

        $data['userTypeUrl'] = 'admin/users';

        return view('users.auth.register', $data);
    }

    public function store(Request $request)
    {
        // Admin creates user
        try {
            $data = [
                'title' => 'User Registration',
                'userTypeUrl' => 'admin/users',
            ];
    
            $data['statesArrayData'] = State::getDetailsByCountryId(101);
    
            $userDataArray = $this->makeUsersPayload($request);
    
            User::create($userDataArray);
    
            return redirect()
                ->route('admin.dashboard.index')
                ->with('success', 'User created successfully.');
        } catch (\Throwable $th) {
            return back()->with('error', 'User Creation Failed!');
        }
    }

    public function edit($id)
    {
        // Edit user
    }

    public function update(Request $request, $id)
    {
        // Update user
    }

    public function destroy($id)
    {
        // Delete/deactivate user
    }

    /**
     * Summary of makeUsersPayload
     * @param Request $request
     * @return array{"created_by": mixed, email: mixed, "first_name": mixed, gender: mixed, "last_name": mixed, password: mixed, phone: mixed, state: mixed, "temp_passowrd": mixed, "user_name": string, "user_type": int}
     */
    private function makeUsersPayload(Request $request) : array
    {
        //TODO:make validation here.

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
