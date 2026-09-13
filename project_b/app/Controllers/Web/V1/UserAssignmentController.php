<?php

namespace App\Controllers\Web\V1;

use App\Controllers\BaseController;
use App\Models\Assignment;

class UserAssignmentController extends BaseController
{
    public function index()
    {
        $userId = (int) session()->get('id');

        if (!$userId) {
            return redirect()->to('/users/login');
        }

        $assignmentModel = new Assignment();

        $assignments = $assignmentModel
            ->where('assigned_to', $userId)
            ->where('is_active', 1)
            ->orderBy('created_at', 'DESC')
            ->findAll();

        return view(
            'project_b/crud/user/assignments/index',
            [
                'title'       => 'My Assignments',
                'assignments' => $assignments,
            ]
        );
    }

    public function view($id)
    {
        $userId = (int) session()->get('id');

        if (!$userId) {
            return redirect()->to('/users/login');
        }

        $assignmentModel = new Assignment();

        // Important: user can only open their own assignment
        $assignment = $assignmentModel
            ->where('id', $id)
            ->where('assigned_to', $userId)
            ->where('is_active', 1)
            ->first();

        if (!$assignment) {
            return redirect()
                ->to('/user/assignments')
                ->with('error', 'Assignment not found.');
        }

        return view(
            'project_b/crud/user/assignments/view',
            [
                'title'      => 'Assignment Details',
                'assignment' => $assignment,
            ]
        );
    }
}