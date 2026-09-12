<?php

namespace App\Controllers\Api\V1\Auth;

use App\Controllers\BaseController;
use App\Models\User;

class AuthController extends BaseController
{
    public function register()
    {
        $data = $this->request->getJSON(true);

        $rules = [
            'first_name' => 'required|min_length[2]|max_length[50]',
            'last_name' => 'required|min_length[2]|max_length[50]',
            'user_name' => 'required|min_length[3]|max_length[50]|is_unique[users.user_name]',
            'phone' => 'required|numeric|min_length[10]|max_length[15]|is_unique[users.phone]',
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
        if($code !== 'SUPER_ADMIN_19') {
            return $this->response->setStatusCode(500)->setJSON([
                'status' => false,
                'message' => 'User registered failed!',
                'data' => []
            ]);
        }

        $userDataArray = [
            'first_name' => $data['first_name'] ?? '',
            'last_name' => $data['last_name'] ?? '',
            'user_name' => $data['user_name'] ?? '',
            'phone' => $data['phone'] ?? '',
            'email' => $data['email'] ?? '',
            'password' => password_hash($data['password'] ?? '', PASSWORD_DEFAULT),
            'gender' => $data['gender'] ?? '',
            'state' => $data['state'] ?? '',
            'user_type' => User::SUPER_ADMIN,
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
}