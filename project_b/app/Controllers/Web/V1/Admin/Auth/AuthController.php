<?php

namespace App\Controllers\Web\V1\Admin\Auth;

use App\Controllers\BaseController;
use App\Models\User;

class AuthController extends BaseController
{
    public function login()
    {
        return view("project_b/crud/admin/auth/login");
    }

    public function loginSubmit()
    {
        $data = [];

        $getMethod = $this->request->getMethod();

       
        helper(['form']);
        if($this->request->getMethod() == 'POST'){

            $rules = [
                'email' => 'required|valid_email',
                'password' => 'required'
            ];

            $errors = [
                "password" => "Email or Password do not match!"
            ];
            
            if(!$this->validate($rules, $errors)){
                $data['validation'] = $this->validator;
            }else{
                $userModel = new User();

                $userEmail = $this->request->getVar('email');
                $userPassword =  $this->request->getVar('password');
                $userModelData = $userModel->where('email',$userEmail)->first();
                
                if ($userModelData !== null) { 
                    if(password_verify($userPassword,$userModelData['password']))
                    {
                        $this->setUserSession($userModelData);
                        return redirect()->to('/admin/index');
                    } else{
                        $data['flashMessage'] = TRUE;
    
                    }
                } else {
                    // No data retrieved
                    $data['validation'] = "Entered email id not found in the system!";
                }
            }
        }

        return view('project_b/crud/login', $data);
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