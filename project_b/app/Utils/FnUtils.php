<?php

namespace App\Utils;

use App\Models\User;

class FnUtils
{
    /**
     * Summary of cleanString
     * @param string $text
     * @return string
     */
    static function cleanString(string $text) : string
    {
        $response = trim($text);
        return $response;
    }

    /**
     * Summary of getDetailsByUserType
     * @param mixed $userId
     * @return array{userTypeUrl: string|string[]}
     */
    static function getDetailsByUserType($userId = null) : array
    {
        $data['userTypeUrl'] = 'users';
        $data['headerName']  = 'Update User Data';

        $currentUserId = (int) session()->get('id');
        $userType      = (int) session()->get('user_type');
        $userId        = (int) $userId;
        
        if ($userType === User::ADMIN) {

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

    /**
     * Summary of userValidationRules
     * @param string $type
     * @return array{email: string, firstname: string, gender: string, lastname: string, phone: string, state: string}
     */
    public static function userValidationRules(string $type = 'add'): array
    {
        $rules = [
            'firstname' => "required|regex_match[/^[a-zA-Z0-9 .'-]+$/]|min_length[3]|max_length[50]",

            'lastname' => "required|regex_match[/^[a-zA-Z0-9 .'-]+$/]|min_length[2]|max_length[50]",

            'email' => 'required|min_length[8]|max_length[100]|valid_email',

            'phone' => 'required|trim|numeric|min_length[10]|max_length[10]',

            'gender' => 'required',

            'state' => 'required',
        ];

        // Only required during ADD
        if ($type === 'add') {
            $rules['email'] .= '|is_unique[users.email]';

            $rules['password'] = 'required';

            $rules['confirmpassword'] = 'matches[password]';
        }

        return $rules;
    }

    public static function validatePassword(string $password) : array
    {
        // Individual rule validations for detailed feedback
        $checks = [
            'min_length' => strlen($password) >= 8,
            'max_length' => strlen($password) <= 20,
            'uppercase' => (bool) preg_match('/[A-Z]/', $password),
            'lowercase' => (bool) preg_match('/[a-z]/', $password),
            'number' => (bool) preg_match('/[0-9]/', $password),
            'special_char' => (bool) preg_match('/[!@#$%^&*(),.?":{}|<>_\-]/', $password),
        ];

        // Overall pass/fail check
        $isValid = !in_array(false, $checks, true);

        return [
            'status' => $isValid ? 'success' : 'error',
            'valid' => $isValid,
            'checks' => $checks,
            'message' => $isValid ? 'Password meets all requirements.' : 'Password does not meet requirements.'
        ];
    }
}