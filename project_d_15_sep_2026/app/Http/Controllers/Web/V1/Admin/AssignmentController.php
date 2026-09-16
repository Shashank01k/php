<?php

namespace App\Http\Controllers\Web\V1\Admin;

use App\Http\Controllers\Controller;
use App\Models\Assignment;
use App\Models\User;
use Illuminate\Http\Request;

class AssignmentController extends Controller
{
    public function index()
    {
        $id = (int) session('id');

        $assignments = Assignment::query()
            ->leftJoin('users', 'assignments.assigned_to', '=', 'users.id')
            ->where('assignments.created_by', $id)
            ->where('assignments.is_active', 1)
            ->select([
                'assignments.*',
                'users.user_name as assigned_user_name',
            ])
            ->orderBy('assignments.created_at', 'desc')
            ->paginate(10);

        return view('admin.assignments.index', [
            'title' => 'All Assignments',
            'assignments' => $assignments,
        ]);
    }

    public function create()
    {
        $id = (int) session('id');

        $users = User::query()
            ->where('user_type', User::USER)
            ->where('created_by', $id)
            ->where('status', 1)
            ->get();

        return view('admin.assignments.create', [
            'title' => 'Create Assignment',
            'users' => $users,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => [
                'required',
                'min:3',
                'max:255',
            ],

            'description' => [
                'nullable',
            ],

            'technology' => [
                'nullable',
                'max:100',
            ],

            'assigned_to' => [
                'required',
                'integer',
            ],

            'priority' => [
                'required',
                'in:low,medium,high',
            ],

            'due_date' => [
                'nullable',
                'date_format:Y-m-d',
            ],
        ], [
            'title.required' => 'Assignment title is required.',
            'title.min' => 'Assignment title must be at least 3 characters.',
            'title.max' => 'Assignment title cannot exceed 255 characters.',
        ]);

        $id = (int) session('id');

        Assignment::create([
            'title' => trim($validated['title']),
            'description' => isset($validated['description'])
                ? trim($validated['description'])
                : null,
            'technology' => isset($validated['technology'])
                ? trim($validated['technology'])
                : null,
            'assigned_to' => (int) $validated['assigned_to'],
            'assigned_by' => $id,
            'created_by' => $id,
            'status' => 'pending',
            'is_active' => 1,
            'priority' => $validated['priority'],
            'due_date' => $validated['due_date'] ?? null,
        ]);

        return redirect()
            ->route('admin.assignments.index')
            ->with('success', 'Assignment created successfully.');
    }

    public function destroy($id)
    {
        $assignment = Assignment::find($id);

        if (!$assignment) {
            return redirect()
                ->route('admin.assignments.index')
                ->with('error', 'Assignment not found.');
        }

        // Soft delete
        $assignment->update([
            'is_active' => 0,
        ]);

        return redirect()
            ->route('admin.assignments.index')
            ->with('success', 'Assignment deleted successfully.');
    }

    public function edit($id)
    {
        $loggedinUserId = (int) session('id');

        $assignment = Assignment::query()
            ->where('created_by', $loggedinUserId)
            ->where('is_active', 1)
            ->find($id);

        if (!$assignment) {
            return redirect()
                ->route('admin.assignments.index')
                ->with('error', 'Assignment not found.');
        }

        // Get active normal users
        $users = User::query()
            ->where('user_type', User::USER)
            ->where('created_by', $loggedinUserId)
            ->where('status', 1)
            ->get();

        return view('admin.assignments.edit', [
            'title' => 'Edit Assignment',
            'assignment' => $assignment,
            'users' => $users,
        ]);
    }

    public function update(Request $request, $id)
    {
        $loggedinUserId = (int) session('id');

        $assignment = Assignment::query()
            ->where('created_by', $loggedinUserId)
            ->where('is_active', 1)
            ->find($id);

        if (!$assignment) {
            return redirect()
                ->route('admin.assignments.index')
                ->with('error', 'Assignment not found.');
        }

        $validated = $request->validate([
            'title' => [
                'required',
                'max:255',
            ],

            'technology' => [
                'nullable',
                'max:100',
            ],

            'description' => [
                'nullable',
            ],

            'assigned_to' => [
                'required',
                'integer',
            ],

            'status' => [
                'required',
                'in:pending,in_progress,completed,cancelled',
            ],

            'priority' => [
                'required',
                'in:low,medium,high',
            ],

            'due_date' => [
                'nullable',
                'date_format:Y-m-d',
            ],
        ], [
            'title.required' => 'Title is required.',
            'title.max' => 'Title cannot exceed 255 characters.',
            'assigned_to.required' => 'Please select a user.',
        ]);

        $assignment->update([
            'title' => trim($validated['title']),
            'description' => isset($validated['description'])
                ? trim($validated['description'])
                : null,
            'technology' => isset($validated['technology'])
                ? trim($validated['technology'])
                : null,
            'assigned_to' => (int) $validated['assigned_to'],
            'status' => $validated['status'],
            'priority' => $validated['priority'],
            'due_date' => $validated['due_date'] ?? null,
        ]);

        return redirect()
            ->route('admin.assignments.index')
            ->with('success', 'Assignment updated successfully.');
    }
}
