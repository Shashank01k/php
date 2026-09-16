<?php

use App\Models\User;

if (!function_exists('getLoggedInUser')) {
    function getLoggedInUser(): ?array
    {
        if (!session('isLoggedIn')) {
            return null;
        }

        $userId = session('id');

        if (!$userId) {
            return null;
        }

        $user = User::find($userId);

        if (!$user) {
            return null;
        }

        return [
            'userModel' => $user,
        ];
    }
}