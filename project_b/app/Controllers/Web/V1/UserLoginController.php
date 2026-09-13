<?php

namespace App\Controllers\Web\V1;

use App\Controllers\BaseController;
use App\Models\User;
use CodeIgniter\HTTP\ResponseInterface;

class UserLoginController extends BaseController
{
    private function setUserSession($userData){
        $data = [
            'id' => $userData['id'],
            'firstname' => $userData['user_name'],
            'email' => $userData['email'],
            'user_type' => $userData['user_type'],
            'isLoggedIn' => true
        ];

        session()->set($data);
        return true;
    }

    public function logout()
    {
        session()->destroy();

        return redirect()->to('/users/login');
    }

    public function signIn()
    {
        $data = [
            'title' => 'User Login',
        ];

        if (session()->get('isLoggedIn')) {
            return redirect()->to('users/dashboard');
        }

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
                $data['validation'] = $this->validator->listErrors();
            }else{
                $userModel = new User();

                $userEmail = $this->request->getVar('email');
                $userPassword =  $this->request->getVar('password');
                $userModelData = $userModel->where('email',$userEmail)->where('user_type', User::USER)->first();

                if ($userModelData !== null) { 
                    if(password_verify($userPassword,$userModelData['password']))
                    {
                        $this->setUserSession($userModelData);
                        return redirect()->to('users/dashboard');
                    } else{
                        $data['flashMessage'] = TRUE;
    
                    }
                } else {
                    $data['validation'] = "Entered email id not found in the system!";
                }
            }
        }
        return view('project_b/crud/sign_in',$data);
    }
}
