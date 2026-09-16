<?php

namespace App\Utils;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class FnUtils
{
    public static function validatePassword(
        string $password,
        string $confirmPassword
    ): array {
        // Individual rule validations for detailed feedback
        $checks = [
            'min_length' => strlen($password) >= 8,
            'max_length' => strlen($password) <= 20,
            'uppercase' => (bool) preg_match('/[A-Z]/', $password),
            'lowercase' => (bool) preg_match('/[a-z]/', $password),
            'number' => (bool) preg_match('/[0-9]/', $password),
            'special_char' => (bool) preg_match(
                '/[!@#$%^&*(),.?":{}|<>_\-]/',
                $password
            ),
            'match_password' => $password === $confirmPassword,
        ];

        // Overall pass/fail check
        $isValid = !in_array(false, $checks, true);

        return [
            'csrfName' => csrf_token(),
            'csrfHash' => csrf_token(),
            'status' => $isValid ? 'success' : 'error',
            'valid' => $isValid,
            'checks' => $checks,
            'message' => $isValid
                ? 'Password meets all requirements.'
                : 'Password does not meet requirements.',
        ];
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
                return [
                    'userTypeUrl' => 'admin',
                    'headerName' => 'Update Admin Data',
                ];
            }

            return [
                'userTypeUrl' => 'admin/users',
                'headerName' => 'Update User Data',
            ];
        }

        if ($userType === User::USER && $userId === $currentUserId) {
            return [
                'userTypeUrl' => 'users',
                'headerName' => 'Update Data',
            ];
        }

        return $data;
    }
}