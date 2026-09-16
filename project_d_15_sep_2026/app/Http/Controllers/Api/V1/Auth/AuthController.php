<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Utils\FnUtils;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    /**
     * Register a new user.
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => ['required', 'min:2', 'max:50'],
            'last_name'  => ['required', 'min:2', 'max:50'],

            'user_name' => [
                'required',
                'min:3',
                'max:50',
                'unique:users,user_name',
            ],

            // Phone validation was commented out in CodeIgniter,
            // so we are keeping it optional here.
            // 'phone' => [
            //     'required',
            //     'numeric',
            //     'min_digits:10',
            //     'max_digits:15',
            //     'unique:users,phone',
            // ],

            'email' => [
                'required',
                'email',
                'unique:users,email',
            ],

            'password' => [
                'required',
                'min:8',
            ],

            'gender' => [
                'required',
                'in:male,female,other',
            ],

            'state' => [
                'required',
                'max:100',
            ],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status'  => false,
                'message' => 'Validation failed',
                'errors'  => $validator->errors(),
            ], 422);
        }

        /*
        |--------------------------------------------------------------------------
        | User Type Code
        |--------------------------------------------------------------------------
        */

        $code = $request->input('code', '');

        $userTypeCodes = [
            'ADMIN_19',
            'SUPER_ADMIN_19',
            'SUB_ADMIN_19',
        ];

        if (!in_array($code, $userTypeCodes, true)) {
            return response()->json([
                'status'  => false,
                'message' => 'You do not have access',
                'errors'  => [],
            ], 500);
        }

        /*
        |--------------------------------------------------------------------------
        | Determine User Type
        |--------------------------------------------------------------------------
        */

        $userType = User::USER;

        if ($code === 'SUPER_ADMIN_19') {
            $userType = User::SUPER_ADMIN;
        }

        if ($code === 'ADMIN_19') {
            $userType = User::ADMIN;
        }

        if ($code === 'SUB_ADMIN_19') {
            $userType = User::SUB_ADMIN;
        }

        /*
        |--------------------------------------------------------------------------
        | Create User
        |--------------------------------------------------------------------------
        */

        $userData = [
            'first_name' => $request->input('first_name', ''),
            'last_name'  => $request->input('last_name', ''),
            'user_name'  => $request->input('user_name', ''),
            'phone'      => $request->input('phone', ''),
            'email'      => $request->input('email', ''),

            // Password should be hashed before storing.
            'password'   => Hash::make($request->input('password')),

            'gender'     => $request->input('gender', ''),
            'state'      => $request->input('state', ''),
            'user_type'  => $userType,
        ];

        try {
            $user = User::create($userData);

            return response()->json([
                'status'  => true,
                'message' => 'User registered successfully',
                'data'    => $user,
            ], 201);

        } catch (\Throwable $e) {

            return response()->json([
                'status'  => false,
                'message' => 'User registration failed',
                'errors'  => [
                    'exception' => $e->getMessage(),
                ],
            ], 400);
        }
    }
}