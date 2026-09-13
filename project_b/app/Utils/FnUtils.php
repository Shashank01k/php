<?php

namespace App\Utils;

use App\Models\User;

class FnUtils
{
    static function cleanString(string $text) : string
    {
        $response = trim($text);
        return $response;
    }

    static function getDetailsByUserType($userId = null) : array
    {
        $data['userTypeUrl'] = 'users';
        $data['headerName']  = 'Update User Data';

        $currentUserId = (int) session()->get('id');
        $userType      = (int) session()->get('user_type');
        $userId        = (int) $userId;

        
        if ($userType === User::SUPER_ADMIN) {
            // dd($userType, User::SUPER_ADMIN);

            if ($userId === $currentUserId) {
                // Super admin updating their own profile
                $data['headerName']  = 'Update Admin Data';
                $data['userTypeUrl'] = 'admin';

                return [
                    'userTypeUrl' => 'admin',
                ];
            } else {
                // Super admin updating another user
                $data['headerName']  = 'Update User Data';
                $data['userTypeUrl'] = 'admin/users';

                return [
                    'userTypeUrl' => 'admin/users',
                ];
            }

        } elseif ($userType === User::USER && $userId === $currentUserId) {

            // Normal user updating their own profile
            $data['headerName']  = 'Update Data';
            $data['userTypeUrl'] = 'users';
            return [
                'userTypeUrl' => 'users',
            ];
        }
        return $data;
    }
}