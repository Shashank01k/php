<?php

namespace App\Controllers\Web\V1;

// TODO:use const
use App\Constants\UserConstant;
use App\Controllers\BaseController;
use App\Database\Seeds\UsersModelSeeder;
use App\Models\User;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Database\RawSql;
use CodeIgniter\Database\Seeder;
use Config\Database;

class UserDashboardController extends BaseController
{
    public function __construct() {
    }

    public function index()
    {
        $page = (int) ($this->request->getGet('page') ?? 1);

        $perPage = 5;

        $tblNewsModel = new \App\Models\TblUsersModel();

        $tableData = $tblNewsModel->paginateNews($perPage, $page);

        $total = $tblNewsModel->getTotalCount();

        // Create pager
        $pager = \Config\Services::pager();

        $paginationLinks = $pager->makeLinks(
            $page,
            $perPage,
            $total,
            'default_full'
        );

        $data = [
            'title' => 'Dashboard',
            'userDataArray' => $tableData,
            'total' => $total,
            'paginationLinks' => $paginationLinks,
            'page' => $page,
            'perPage' => $perPage,
            'status' => 'success'
        ];

        return view('project_b/crud/admin/index', $data);
    }
    
    public function dashboard()
    {
        $page = (int) ($this->request->getGet('page') ?? 1);

        $perPage = 5;

        $tblNewsModel = new \App\Models\TblUsersModel();

        $tableData = $tblNewsModel->paginateNews($perPage, $page);

        $total = $tblNewsModel->getTotalCount();

        // Create pager
        $pager = \Config\Services::pager();

        $paginationLinks = $pager->makeLinks(
            $page,
            $perPage,
            $total,
            'default_full'
        );

        $data = [
            'title' => 'Dashboard',
            'userDataArray' => $tableData,
            'total' => $total,
            'paginationLinks' => $paginationLinks,
            'page' => $page,
            'perPage' => $perPage,
            'status' => 'success'
        ];

        return view('project_b/crud/dashboard', $data);
    }
    
    public function terms()
    {
        return view('project_b/crud/terms');
    }

    public function insertDummyData()
    {
        $data = [];
        $number = $this->request->getVar('number');
        $data['message'] = "Insert input number for create dummy Data...🤠🤠🤠";

        if($number != ''){
            $usersModelSeeder = new UsersModelSeeder();

            $run = $usersModelSeeder->run($number);

            $data['message'] = "Dummy Data Inserted Successfully...😎😎😎";
        }

        return view('project_b/crud/admin/seeder',$data);
    }

    public function profile()
    {
        $userId = session()->get('id');
        $userType = session()->get('user_type');
        
        $userModel = new User();
        
        $userDataArray = $userModel->getUserWithState($userId);

        if($userType == User::SUPER_ADMIN) {
            return view('project_b/crud/admin/profile', [
                'title' => 'Admin Profile',
                'userDataArray' => $userDataArray,
            ]);
        }

        return view('project_b/crud/user/profile', [
            'title' => 'Users Profile',
            'userDataArray' => $userDataArray,
        ]);
    }
}