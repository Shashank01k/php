<?php

use App\Models\User;

if (!function_exists('getLoggedInUser')) {
    function getLoggedInUser(): ?array
    {
        if (!session()->get('isLoggedIn')) {
            return null;
        }

        $userId = session()->get('id');

        if (!$userId) {
            return null;
        }

        $userModel = new User();

        $data = [
            'userModel' => $userModel->find($userId),
        ];

        return $data;
    }
}