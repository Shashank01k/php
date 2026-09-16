<?php

namespace App\Http\Controllers\Web\V1\Admin;

use App\Http\Controllers\Controller;
use App\Models\Assignment;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $page = (int) ($request->query('page') ?? 1);

        $perPage = (int) $request->query('perPage');

        if ($perPage < 5) {
            $perPage = 5;
        }

        if ($perPage > 100) {
            $perPage = 100;
        }

        $userModel = new User();


        $tableData = $userModel->paginateNews($perPage, $page);

        $total = $userModel->getTotalCount();

        $id = (int) session('id');

        //TODO:make a another method for this
        $assignmentModel = new Assignment();

        $assignmentStats = $assignmentModel->getAdminAssignmentStats($id);

        $summary = [
            'totalUsers' => User::where('created_by', $id)
                ->count(),

            'totalAssignments' => $assignmentStats['totalAssignments'],

            'pendingAssignments' => $assignmentStats['pendingAssignments'],

            'completedAssignments' => $assignmentStats['completedAssignments'],
        ];

        $assignments = $assignmentModel->getAssignments($id);

        $data = [
            'title' => 'Dashboard',

            'userDataArray' => $tableData,

            'total' => $total,

            'page' => $page,

            'perPage' => $perPage,

            'status' => 'success',

            'assignments' => $assignments,

            'summary' => $summary,

            'userModel' => User::find($id),
        ];

        return view('admin.dashboard.index', $data);
    }

    public function profile()
    {
        $userId = (int) session('id');

        $userDataArray = User::query()
            ->leftJoin('states as st', 'users.state', '=', 'st.id')
            ->where('users.id', $userId)
            ->select([
                'users.*',
                'st.name as state_name',
            ])
            ->first();

        if (!$userDataArray) {
            return redirect()
                ->route('admin.dashboard.index')
                ->with('error', 'User not found.');
        }

        return view('admin.profile.index', [
            'title' => 'Admin Profile',
            'userDataArray' => $userDataArray,
        ]);
    }
}
