<?php

namespace App\Http\Controllers\Web\V1\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Utils\FnUtils;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserUpdateController extends Controller
{
    /**
     * Show profile update form.
     */
    public function edit($userId)
    {
        $userId = (int) $userId;

        $user = User::find($userId);

        if (!$user) {
            return redirect()
                ->back()
                ->with('error', 'User not found.');
        }

        $statesArrayData = DB::table('states')
            ->where('country_id', 101)
            ->get();

        $userType = (int) session('user_type');
        $currentUserId = (int) session('id');

        $data = [
            'userDataArray' => $user,
            'statesArrayData' => $statesArrayData,
            'title' => 'User Updation',
            'userTypeUrl' => 'users',
            'headerName' => 'Update User Data',
        ];

        $data['userTypeUrl'] = FnUtils::getDetailsByUserType($userId)['userTypeUrl'];

        $userTypeName = 'users';

        return view($userTypeName.'.profile.update', $data);
    }

    /**
     * Update user profile.
     */
    public function update(Request $request, $userId)
    {
        $userId = (int) $userId;

        $userType = (int) session('user_type');

        $user = User::find($userId);

        if (!$user) {
            return redirect()
                ->back()
                ->with('error', 'User not found.');
        }

        $request->validate(
            FnUtils::userValidationRules('update')
        );

        $firstName = $request->input('firstname');
        $lastName = $request->input('lastname');

        $userDataArray = [
            'first_name' => $firstName,
            'last_name' => $lastName,
            'user_name' => $firstName . ' ' . $lastName,
            'phone' => $request->input('phone'),
            'gender' => $request->input('gender'),
            'state' => $request->input('state'),
        ];

        $user->update($userDataArray);

        $userTypeName = 'users';
        if (User::ADMIN == $userType) {
            $userTypeName = 'admin.users';
        }

        return redirect()
            ->route($userTypeName.'.profile.edit', $userId)
            ->with('updateMessage', 'Updated Successfully');
    }
}