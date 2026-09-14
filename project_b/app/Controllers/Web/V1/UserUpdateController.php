<?php

namespace App\Controllers\Web\V1;

use App\Controllers\BaseController;
use App\Models\States;
use App\Models\User;
use App\Utils\FnUtils;

class UserUpdateController extends BaseController
{
    public $states;

    public function __construct()
    {
        $this->states = new States;
    }

    public function update($userId)
    {
        //TODO:make two method get and post
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/admin/login');
        }

        $data = [];

        $db = db_connect();
        $userModel = new User();
        $userDataArray = $userModel->where('id', $userId)->first();
        $data['userDataArray'] = $userDataArray;

        $countryID = 101;
        $statesData = $this->states->where('country_id',$countryID)->get();
        $statesArrayData = $statesData->getResultArray();
        $data['statesArrayData'] = $statesArrayData;
        $data['title'] = 'User Updation';
        
        helper(['form']);
        
        if($this->request->getMethod() == 'POST'){
            $rules = FnUtils::userValidationRules('update');

            if(!$this->validate($rules)){
                $data['validation'] = $this->validator;
            }else{
                
                $firstName = $this->request->getVar('firstname');
                $lastName = $this->request->getVar('lastname');
                $userName = $firstName.' '.$lastName;
                
                $userDataArray = [
                    'first_name' => $firstName,
                    'last_name' => $lastName,
                    'user_name' => $userName,
                    'phone' => $this->request->getVar('phone'),
                    'gender' => $this->request->getVar('gender'),
                    'state' => $this->request->getVar('state'),
                ];

                $userModelResponse = $userModel->update($userId,$userDataArray);
                $affectedRows  = $db->affectedRows();

                $data['flashMessage'] = "Nothing to Update";
                session()->remove('updateMessage');

                if($db->affectedRows()){
                    $data['updateMessage'] = "Updated Successfully";

                    session()->set(array('updateMessage'=>"Updated Successfully"));
                  
                    return redirect()->to(current_url());
                }
                
                if($userModel->update($userId,$userDataArray)){
                    // $data['flashMessage'] = TRUE;
                }
            }
        }

        $data["userTypeUrl"] = 'users';
        $data["headerName"] = 'Update User Data';

        $userType = session()->get("user_type");

        if ($userType == User::ADMIN && $userId == session()->get("id")) {
            $data["headerName"] = 'Update Admin Data';
            $data["userTypeUrl"] = 'admin';
        }elseif ($userType == User::ADMIN && $userId !== session()->get("id")) {
            $data["headerName"] = 'Update User Data';
            $data["userTypeUrl"] = 'admin/users';
        } elseif ($userType == User::USER && $userId == session()->get("id")) {
            $data["headerName"] = 'Update Data';
            $data["userTypeUrl"] = 'users';
        }

        return view('project_b/crud/update',$data);
    }
}
