<?php

namespace App\Http\Controllers\Web\V1\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $page = (int) ($request->query('page') ?? 1);

        $perPage = 5;

        $userModel = new User();

        $tableData = $userModel->paginateNews($perPage, $page);

        $total = $userModel->getTotalCount();

        $data = [
            'title' => 'Dashboard',
            'userDataArray' => $tableData,
            'total' => $total,
            'page' => $page,
            'perPage' => $perPage,
            'status' => 'success',
        ];

        return view('users.dashboard.index', $data);
    }
}
