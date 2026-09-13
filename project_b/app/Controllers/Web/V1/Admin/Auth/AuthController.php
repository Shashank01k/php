<?php

namespace App\Controllers\Web\V1\Admin\Auth;

use App\Controllers\BaseController;
use App\Models\User;

class AuthController extends BaseController
{
    public function index()
    {
        return view('project_b/crud/admin/auth/login');
    }

    public function loginSubmit()
    {
        $rules = [
            'email' => 'required|valid_email',
            'password' => 'required'
        ];

        $errors = [
            "password" => "Email or Password do not match!"
        ];

        if (!$this->validate($rules, $errors)) {
            $data['validation'] = $this->validator;

            return view('project_b/crud/admin/login', $data);
        }
        
        $userEmail = $this->request->getVar('email');
        $userPassword =  $this->request->getVar('password');
        
        $userModelData = (New User())->where('email',$userEmail)
            ->where('user_type', User::ADMIN)
            ->first();
        
        if ($userModelData !== null) { 
            if (password_verify($userPassword,$userModelData['password'])) {
                $this->setUserSession($userModelData);
                
                return redirect()->to('/admin/index');
            } else {
                    session()->setFlashdata(
                        'flashMessage',
                        'Invalid password.'
                    );

                    return redirect()->back();
            }
        }
        session()->setFlashdata(
            'flashMessage',
            'Entered email id not found in the system!'
        );

        return redirect()->back();
    }

    public function logout()
    {
        session()->destroy();

        return redirect()->to('admin/login');
    }

    private function setUserSession($userData){
        $data = [
            'id' => $userData['id'],
            'firstname' => $userData['user_name'],
            'email' => $userData['email'],
            'isLoggedIn' => true,
            'user_type' => $userData['user_type'],
            'userTypeUrl' => 'admin',
        ];

        session()->set($data);

        return true;
    }
}