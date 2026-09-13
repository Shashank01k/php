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
        $data = [
            'title' => 'User Registration Form',
        ];

        $data['statesArrayData'] = self::formDetails()['statesArrayData'];

        $data['userTypeUrl'] = FnUtils::getDetailsByUserType()['userTypeUrl'];
        
        return view('project_b/crud/sign_up', $data);    
    }

    public function signUpSubmit()
    {
        $data = [
            'title' => 'User Registration',
        ];

        $data['statesArrayData'] = self::formDetails()['statesArrayData'];
        
        $getBody = $this->request->getBody();
        parse_str($getBody, $dataArray);

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

        $userId = null;
        if(!$this->validate($rules)){
            $data['validation'] = $this->validator;
        }else{
            $userModel = new User();
            
            $userDataArray = self::makeUsersPayload($this->request);

            if($userModel->save($userDataArray)){
                $userId = $userModel->getInsertID();

                $data['flashMessage'] = TRUE;
                if (session()->get('user_type' == User::ADMIN)) {
                    return redirect()->to('/admin/index');
                }

                return view('project_b/crud/sign_in');
            }
        }

        $data['userTypeUrl'] = FnUtils::getDetailsByUserType($userId)['userTypeUrl'];

        return view('project_b/crud/sign_up', $data);    
    }

    /**
     * Summary of makeUsersPayload
     * @param mixed $request
     * @return array{email: array|bool|float|int|string|\stdClass|null, "first_name": array|bool|float|int|string|\stdClass|null, gender: array|bool|float|int|string|\stdClass|null, "last_name": array|bool|float|int|string|\stdClass|null, password: array|bool|float|int|string|\stdClass|null, phone: array|bool|float|int|string|\stdClass|null, state: array|bool|float|int|string|\stdClass|null, "user_name": string, "user_type": int}
     */
    private function makeUsersPayload($request) : array
    {
        $createdBy = session()->get('id') ?? null;

        $firstName = $request->getVar('firstname');
        $lastName = $request->getVar('lastname');
        $userName = $firstName.' '.$lastName;

        return [
            'first_name' => $firstName,
            'last_name' => $lastName,
            'user_name' => $userName,
            'phone' => $request->getVar('phone'),
            'email' => $request->getVar('email'),
            'password' => $request->getVar('password'),
            'gender' => $request->getVar('gender'),
            'state' => $request->getVar('state'),
            'user_type' => User::USER,
            'created_by' => $createdBy,
        ];
    }

    private function formDetails()
    {
        $countryID = 101;

        $statesData = $this->states->where('country_id',$countryID)->get();
        $statesArrayData = $statesData->getResultArray();

        return [
            'countryID' => $countryID,
            'statesArrayData' => $statesArrayData
        ];
    }
}
