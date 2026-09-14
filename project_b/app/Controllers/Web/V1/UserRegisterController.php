<?php

namespace App\Controllers\Web\V1;

use App\Controllers\BaseController;
use App\Models\States;
use App\Repositories\StateRepository;
use App\Models\User;
use App\Utils\FnUtils;

class UserRegisterController extends BaseController
{
    public $stateRepository;
    public $states;
    public FnUtils $fnUtils;
    
    public function __construct()
    {
        $this->states = new States;
        $this->fnUtils = new FnUtils;
    }

    public function test()
    {
        return json_encode([
            'status'  => 'success',
            'message' => 'User created successfully',
            'received' => [
                'name'  => 'sahah',
                'email' => "email"
            ]
        ]);
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
        // dd('popi');
        $data = [
            'title' => 'User Registration',
        ];

        $data['statesArrayData'] = self::formDetails()['statesArrayData'];
        
        $getBody = $this->request->getBody();
        parse_str($getBody, $dataArray);

        $rules = FnUtils::userValidationRules();

        $userId = null;
        
        if(!$this->validate($rules)){
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }
            
        $userModel = new User();
        
        $userDataArray = self::makeUsersPayload($this->request);

        if($userModel->save($userDataArray)){
            $userId = $userModel->getInsertID();

            $data['flashMessage'] = TRUE;
            if (session()->get('user_type') == User::ADMIN) {
                return redirect()->to('/admin/index');
            }

            return redirect()
                ->to('/users/login')
                ->with('success', 'Account created successfully. Please login.');
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

        $gmailUsername = trim($this->request->getVar('gmail_username'));
        $customEmail   = trim($this->request->getVar('email'));

        //TODO:remove this
        // if (!empty($gmailUsername)) {
        //     $email = $gmailUsername . '@gmail.com';
        // } else {
        //     $email = $customEmail;
        // }

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
