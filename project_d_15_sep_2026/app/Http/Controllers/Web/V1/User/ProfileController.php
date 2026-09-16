<?php

namespace App\Http\Controllers\Web\V1\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Utils\FnUtils;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * Update Admin profile.
     */
    public function update(Request $request, $userId)
    {
        $userId = (int) $userId;

        $user = User::find($userId);

        if (!$user) {
            return redirect()
                ->back()
                ->with('error', 'User not found.');
        }

        $rules = FnUtils::userValidationRules('update');

        $request->validate($rules);

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

        return redirect()
            ->route('admin.profile.edit', $userId)
            ->with('updateMessage', 'Admin Updated Successfully');
    }
}
