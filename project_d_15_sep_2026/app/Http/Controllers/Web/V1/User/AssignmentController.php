<?php

namespace App\Http\Controllers\Web\V1\User;

use App\Http\Controllers\Controller;
use App\Models\Assignment;
use Illuminate\Http\Request;

class AssignmentController extends Controller
{
    public function index(Request $request)
    {
        $userId = (int) session('id');

        $search = trim($request->input('search', ''));
        $status = $request->input('status', '');
        $priority = $request->input('priority', '');

        $assignments = Assignment::query()
            ->where('assigned_to', $userId)
            ->where('is_active', 1)

            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($query) use ($search) {
                    $query->where('title', 'like', "%{$search}%")
                        ->orWhere('description', 'like', "%{$search}%")
                        ->orWhere('technology', 'like', "%{$search}%");
                });
            })

            ->when($status !== '', function ($query) use ($status) {
                $query->where('status', $status);
            })

            ->when($priority !== '', function ($query) use ($priority) {
                $query->where('priority', $priority);
            })

            ->orderByDesc('created_at')
            ->paginate(10)
            ->withQueryString();

        return view('users.assignments.index', [
            'title' => 'My Assignments',
            'assignments' => $assignments,
            'search' => $search,
            'status' => $status,
            'priority' => $priority,
        ]);
    }

    public function show($id)
    {
        $userId = (int) session('id');

        $assignment = Assignment::query()
            ->where('id', $id)
            ->where('assigned_to', $userId)
            ->where('is_active', 1)
            ->first();

        if (!$assignment) {
            return redirect()
                ->route('users.assignments.index')
                ->with('error', 'Assignment not found.');
        }

        return view('users.assignments.show', [
            'title' => 'Assignment Details',
            'assignment' => $assignment,
        ]);
    }

    public function start($id)
    {
        $userId = (int) session('id');

        $assignment = Assignment::query()
            ->where('id', $id)
            ->where('assigned_to', $userId)
            ->where('is_active', 1)
            ->first();

        if (!$assignment) {
            return redirect()
                ->route('users.assignments.index')
                ->with('error', 'Assignment not found.');
        }

        if ($assignment->status === 'pending') {
            $assignment->update([
                'status' => 'in_progress',
            ]);
        }

        return redirect()
            ->route('users.assignments.show', $assignment->id)
            ->with('success', 'Assignment started successfully.');
    }
}