<?php

namespace App\Controllers\Web\V1;

use App\Controllers\BaseController;
use App\Models\States;
use App\Repositories\StateRepository;
use App\Models\User;
use App\Utils\FnUtils;

// use App\Repositories\StateRepository;

class UserRegisterController extends BaseController
{
    public $stateRepository;
    public $states;
    public FnUtils $fnUtils;
    
    public function __construct()
    {
        // $this->stateRepository = new StateRepository();
        $this->states = new States;
        $this->fnUtils = new FnUtils;
    }

    public function signUp()
    {
        $data = [];
        $rules = [];
        $countryID = 101;

        $data = [
            'title' => 'User Registration',
        ];

        $statesData = $this->states->where('country_id',$countryID)->get();
        $statesArrayData = $statesData->getResultArray();
        $data['statesArrayData'] = $statesArrayData;
        
        $getBody = $this->request->getBody();
        parse_str($getBody, $dataArray);

        helper(['form']);
        if($this->request->getMethod() == 'POST'){
            $rules = [
                'firstname' => 'required|regex_match[/^[a-zA-Z .]+$/]|min_length[3]|max_length[50]',
                'lastname' => 'required|regex_match[/^[a-zA-Z .]+$/]|min_length[2]|max_length[50]',
                'email' => 'required|min_length[8]|max_length[100]|valid_email|is_unique[users.email]',
                // 'password' => 'required|regex_match[/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[!@#$%^&*()-_+=])[A-Za-z\d!@#$%^&*()-_+=]{8,}$/]|min_length[8]|max_length[50]',
                'password' => 'required',
                'confirmpassword' => 'matches[password]',
                'phone' => 'required|trim|required|numeric|min_length[10]|max_length[10]',
                'gender' => 'required',
                'state' => 'required',
            ];

            if(!$this->validate($rules)){
                $data['validation'] = $this->validator;
            }else{
                $userModel = new User();

                $firstName = $this->request->getVar('firstname');
                $lastName = $this->request->getVar('lastname');
                $userName = $firstName.' '.$lastName;
                
                $userDataArray = [
                    'first_name' => $firstName,
                    'last_name' => $lastName,
                    'user_name' => $userName,
                    'phone' => $this->request->getVar('phone'),
                    'email' => $this->request->getVar('email'),
                    'password' => $this->request->getVar('password'),
                    'gender' => $this->request->getVar('gender'),
                    'state' => $this->request->getVar('state'),
                    'user_type' => User::USER,
                ];
    
                if($userModel->save($userDataArray)){
                    $data['flashMessage'] = TRUE;
                    return view('project_b/crud/sign_in'); 

                }
            }
        }

        return view('project_b/crud/sign_up',$data);    
    }
}
