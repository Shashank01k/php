<?php

namespace App\Controllers\Web\V1\Admin;

use App\Controllers\BaseController;
use App\Models\Assignment;
use App\Models\User;

class AssignmentController extends BaseController
{
    public function index()
    {
        $assignmentModel = new Assignment();

        $id = (int) session()->get('id');

        $data = [
            'title'       => 'All Assignments',
            'assignments' => $assignmentModel
                ->getAssignmentsWithUsers($id)
                ->paginate(10),
            'pager'       => $assignmentModel->pager,
        ];

        return view(
            'project_b/crud/admin/assignments/index',
            $data
        );
    }

    public function create()
    {
        $assignmentModel = new Assignment();
        $userModel       = new User();

        $id = session()->get('id');

        // GET: show form
        if ($this->request->getMethod() === 'GET') {
            $data = [
                'title'     => 'Create Assignment',
                'users'     => $userModel
                    ->where('user_type', User::USER)
                    ->where('created_by', $id)
                    ->findAll(),
                'validation' => null,
            ];

            return view(
                'project_b/crud/admin/assignments/create',
                $data
            );
        }

        // POST: validate and save
        $rules = [
            'title' => [
                'rules'  => 'required|min_length[3]|max_length[255]',
                'errors' => [
                    'required'   => 'Assignment title is required.',
                    'min_length' => 'Assignment title must be at least 3 characters.',
                    'max_length' => 'Assignment title cannot exceed 255 characters.',
                ],
            ],

            'description' => [
                'rules' => 'permit_empty',
            ],

            'technology' => [
                'rules'  => 'permit_empty|max_length[100]',
            ],

            'assigned_to' => [
                'rules'  => 'required|integer',
            ],

            'priority' => [
                'rules'  => 'required|in_list[low,medium,high]',
            ],

            'due_date' => [
                'rules'  => 'permit_empty|valid_date[Y-m-d]',
            ],
        ];

        if (! $this->validate($rules)) {

            return view(
                'project_b/crud/admin/assignments/create',
                [
                    'title'      => 'Create Assignment',
                    'users'      => $userModel
                        ->where('user_type', User::USER)
                        ->where('is_active', 1)
                        ->findAll(),
                    'validation' => $this->validator,
                ]
            );
        }

        $assignmentData = [
            'title'        => trim($this->request->getPost('title')),
            'description'  => trim($this->request->getPost('description')),
            'technology'   => trim($this->request->getPost('technology')),
            'assigned_to'  => (int) $this->request->getPost('assigned_to'),
            'assigned_by'  => (int) session()->get('id'),
            'created_by'   => (int) session()->get('id'),
            'status'       => 'pending',
            'is_active'    => 1,
            'priority'     => $this->request->getPost('priority'),
            'due_date'     => $this->request->getPost('due_date') ?: null,
        ];

        if ($assignmentModel->insert($assignmentData)) {

            return redirect()
                ->to('/admin/index')
                ->with('success', 'Assignment created successfully.');
        }

        return redirect()
            ->back()
            ->withInput()
            ->with('error', 'Unable to create assignment.');
    }

    public function edit($id)
    {
        $assignmentModel = new Assignment();
        $userModel       = new User();

        $loggedinUserId = session()->get('id');

        $assignment = $assignmentModel->where('created_by', $loggedinUserId)
            ->find($id);

        if (!$assignment) {
            return redirect()
                ->to('/admin/assignments')
                ->with('error', 'Assignment not found.');
        }

        // Get active normal users
        $users = $userModel
            ->where('user_type', User::USER)
            ->where('created_by', $loggedinUserId)
            ->where('status', 1)
            ->findAll();

        if ($this->request->getMethod() === 'POST') {

            $rules = [
                'title' => [
                    'rules'  => 'required|max_length[255]',
                    'errors' => [
                        'required'   => 'Title is required.',
                        'max_length' => 'Title cannot exceed 255 characters.',
                    ],
                ],
                'technology' => 'permit_empty|max_length[100]',
                'description' => 'permit_empty',
                'assigned_to' => [
                    'rules'  => 'required|is_natural_no_zero',
                    'errors' => [
                        'required' => 'Please select a user.',
                    ],
                ],
                'status' => [
                    'rules' => 'required|in_list[pending,in_progress,completed,cancelled]',
                ],
                'priority' => [
                    'rules' => 'required|in_list[low,medium,high]',
                ],
                'due_date' => 'permit_empty|valid_date[Y-m-d]',
            ];

            if (!$this->validate($rules)) {
                return view(
                    'project_b/crud/admin/assignments/edit',
                    [
                        'title'      => 'Edit Assignment',
                        'assignment' => $assignment,
                        'users'      => $users,
                        'validation' => $this->validator,
                    ]
                );
            }

            $updateData = [
                'title'       => trim($this->request->getPost('title')),
                'description' => trim($this->request->getPost('description')),
                'technology'  => trim($this->request->getPost('technology')),
                'assigned_to' => (int) $this->request->getPost('assigned_to'),
                'status'      => $this->request->getPost('status'),
                'priority'    => $this->request->getPost('priority'),
                'due_date'    => $this->request->getPost('due_date') ?: null,
            ];

            $assignmentModel->update($id, $updateData);

            return redirect()
                ->to('/admin/assignments')
                ->with('success', 'Assignment updated successfully.');
        }

        return view(
            'project_b/crud/admin/assignments/edit',
            [
                'title'      => 'Edit Assignment',
                'assignment' => $assignment,
                'users'      => $users,
            ]
        );
    }

    public function delete($id)
    {
        $assignmentModel = new Assignment();

        $assignment = $assignmentModel->find($id);

        if (!$assignment) {
            return redirect()
                ->to('/admin/assignments')
                ->with('error', 'Assignment not found.');
        }

        // Soft delete
        $assignmentModel->update($id, [
            'is_active' => 0
        ]);

        return redirect()
            ->to('/admin/assignments')
            ->with('success', 'Assignment deleted successfully.');
    }
}