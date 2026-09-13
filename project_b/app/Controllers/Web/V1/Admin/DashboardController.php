<?php

namespace App\Controllers\Web\V1\Admin;
// TODO:use const
use App\Constants\UserConstant;
use App\Controllers\BaseController;
use App\Database\Seeds\UsersModelSeeder;
use App\Models\Assignment;
use App\Models\User;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Database\RawSql;
use CodeIgniter\Database\Seeder;
use Config\Database;

class DashboardController extends BaseController
{
    public function __construct() {
    }

    public function index()
    {
        $page = (int) ($this->request->getGet('page') ?? 1);

        $perPage = (int) $this->request->getGet('perPage');

        if ($perPage < 5) {
            $perPage = 5;
        }

        if ($perPage > 100) {
            $perPage = 100;
        }

        $userModel       = new User();
        $assignmentModel = new Assignment();

        $tableData = $userModel->paginateNews($perPage, $page);

        $total = $userModel->getTotalCount();

        // Create pager
        $pager = \Config\Services::pager();

        $paginationLinks = $pager->makeLinks(
            $page,
            $perPage,
            $total,
            'default_full'
        );

        $id = (int) session()->get('id');

        $userModel       = new User();
        $assignmentModel = new Assignment();

        $assignmentStats = $assignmentModel->getAdminAssignmentStats($id);

        $summary = [
            'totalUsers' => $userModel->where('created_by', $id)->countAllResults(),
            'totalAssignments' => $assignmentStats['totalAssignments'],
            'pendingAssignments' => $assignmentStats['pendingAssignments'],
            'completedAssignments' => $assignmentStats['completedAssignments'],
        ];

        $assignments = $assignmentModel->getAssignments($id);

        $data = [
            'title' => 'Dashboard',
            'userDataArray' => $tableData,
            'total' => $total,
            'paginationLinks' => $paginationLinks,
            'page' => $page,
            'perPage' => $perPage,
            'status' => 'success',
            'assignments' => $assignments,
            'summary' => $summary,
            'userModel' => $userModel->find($id),
        ];

        return view('project_b/crud/admin/index', $data);
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

        $id = (int) session()->get('id');

        if($number != ''){
            $usersModelSeeder = new UsersModelSeeder();

            $run = $usersModelSeeder->run($number, $id);

            $data['message'] = "Dummy Data Inserted Successfully...😎😎😎";
        }

        return view('project_b/crud/admin/seeder', $data);
    }

    public function profile()
    {
        $userId = session()->get('id');

        $userModel = new User();
        
        $userDataArray = $userModel->getUserWithState($userId);

        return view('project_b/crud/admin/profile', [
            'title' => 'Admin Profile',
            'userDataArray' => $userDataArray,
        ]);
    }
}