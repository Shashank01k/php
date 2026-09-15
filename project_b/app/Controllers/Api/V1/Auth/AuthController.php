<?php

namespace App\Controllers\Api\V1\Auth;

use App\Controllers\BaseController;
use App\Models\User;
use App\Utils\FnUtils;

class AuthController extends BaseController
{
    public function register()
    {
        $data = $this->request->getJSON(true);

        $rules = [
            'first_name' => 'required|min_length[2]|max_length[50]',
            'last_name' => 'required|min_length[2]|max_length[50]',
            'user_name' => 'required|min_length[3]|max_length[50]|is_unique[users.user_name]',
            // 'phone' => 'required|numeric|min_length[10]|max_length[15]|is_unique[users.phone]',
            'email' => 'required|valid_email|is_unique[users.email]',
            'password' => 'required|min_length[8]',
            'gender' => 'required|in_list[male,female,other]',
            'state' => 'required|max_length[100]',
        ];

        if (!$this->validateData($data, $rules)) {
            return $this->response->setStatusCode(422)->setJSON([
                'status'  => false,
                'message' => 'Validation failed',
                'errors'  => $this->validator->getErrors()
            ]);
        }

        $code = $data['code'] ?? '';

        $userTypeCodes = [
            'ADMIN_19',
            'SUPER_ADMIN_19',
            'SUB_ADMIN_19'
        ];

        if (!in_array($code , $userTypeCodes)) {
            return $this->response->setStatusCode(500)->setJSON([
                'status'=> false,
                'message'=> 'You do not have access',
                'errors'=> $this->validator->getErrors()
            ]);
        }

        $userType = User::USER;
        if($code === 'SUPER_ADMIN_19') {
            $userType = User::SUPER_ADMIN;
        }

        if($code === 'ADMIN_19') {
           $userType = User::ADMIN;
        }

        $userDataArray = [
            'first_name' => $data['first_name'] ?? '',
            'last_name' => $data['last_name'] ?? '',
            'user_name' => $data['user_name'] ?? '',
            'phone' => $data['phone'] ?? '',
            'email' => $data['email'] ?? '',
            'password' => $data['password'] ?? '',
            'gender' => $data['gender'] ?? '',
            'state' => $data['state'] ?? '',
            'user_type' => $userType,
        ];

        $userModel = new User();

        if ($userModel->insert($userDataArray)) {
            return $this->response->setStatusCode(201)->setJSON([
                'status'  => true,
                'message' => 'User registered successfully',
                'data'    => $userDataArray
            ]);
        }

        return $this->response->setStatusCode(400)->setJSON([
            'status'  => false,
            'message' => 'User registration failed',
            'errors'  => $userModel->errors()
        ]);
    }

    public function validatePassword()
    {
        // 1. Get request input (works for both JSON and Form Data)
        $json = $this->request->getJSON(true);
        
        // 2. Safely extract password parameter
        $password = $json['password'] 
            ?? $this->request->getVar('password') 
            ?? '';

        $confirmPassword = $json['confirmpassword']
            ?? $this->request->getVar('confirmpassword')
            ?? '';

        // 3. Prevent TypeError: If $password is an array or non-string, extract string or cast
        if (is_array($password)) {
            // If nested (e.g., ['password' => 'myPass']), grab first value, otherwise fallback to empty string
            $password = reset($password);
        }

        $passwordStr = (string) $password;
        $confirmPasswordStr = (string) $confirmPassword;


        try {
            $result['csrfName'] = csrf_token();
            $result['csrfHash'] = csrf_hash();

            return $this->response->setJSON($result);
    
        } catch (\Exception $e) {
            return $this->response->setStatusCode(500)
                ->setJSON([
                    'status' => false,
                    'message' => $e->getMessage(),
                    'data' => [],
                    'csrfName' => csrf_token(),
                    'csrfHash' => csrf_hash(),
            ]);
        }
    }
}