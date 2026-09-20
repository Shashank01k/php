<?php

namespace App\Http\Controllers\Web\V1\Admin;

use App\Http\Controllers\Controller;
use App\Models\Interview;
use Illuminate\Http\Request;

class InterviewController extends Controller
{
    public function index(Request $request)
    {
        $id = (int) session('id');

        $perPage = (int) $request->get('perPage', 5);
        $page = (int) $request->get('page', 1);

        $offset = ($page - 1) * $perPage;

        //TODO:move this into model or make repository
        $interviews = Interview::query()
            ->withCount('questions')
            ->where('created_by', $id)
            ->where('is_active', 1)
            ->orderBy('created_at', 'desc')
            ->offset($offset)
            ->limit($perPage)
            ->get();

        $total = Interview::query()
            ->where('created_by', $id)
            ->where('is_active', 1)
            ->count();

        return view('admin.interviews.index', [
            'title' => 'Interviews',
            'interviews' => $interviews,
            'total' => $total,
            'page' => $page,
            'perPage' => $perPage,
        ]);
    }

    public function create()
    {
        return view('admin.interviews.create', [
            'title' => 'Create Interview',
        ]);
    }

    public function show($id)
    {
        $loggedInUserId = (int) session('id');

        $interview = Interview::query()
            ->withCount('questions')
            ->where('id', $id)
            ->where('created_by', $loggedInUserId)
            ->where('is_active', 1)
            ->first();

        if (!$interview) {
            return redirect()
                ->route('admin.interviews.index')
                ->with('error', 'Interview not found.');
        }

        return view('admin.interviews.show', [
            'title' => 'Interview Details',
            'interview' => $interview,
        ]);
    }

    public function edit($id)
    {
        $loggedInUserId = (int) session('id');

        $interview = Interview::query()
            ->where('id', $id)
            ->where('created_by', $loggedInUserId)
            ->where('is_active', 1)
            ->first();

        if (!$interview) {
            return redirect()
                ->route('admin.interviews.index')
                ->with('error', 'Interview not found.');
        }

        return view('admin.interviews.edit', [
            'title' => 'Edit Interview',
            'interview' => $interview,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => [
                'required',
                'string',
                'min:3',
                'max:255',
            ],

            'description' => [
                'nullable',
                'string',
            ],

            'instructions' => [
                'nullable',
                'string',
            ],

            'duration' => [
                'nullable',
                'integer',
                'min:1',
            ],

            'status' => [
                'required',
                'in:draft,published,closed',
            ],

            'is_active' => [
                'nullable',
                'boolean',
            ],
        ], [
            'title.required' => 'Interview title is required.',
            'title.min' => 'Interview title must be at least 3 characters.',
            'title.max' => 'Interview title cannot exceed 255 characters.',

            'duration.integer' => 'Duration must be a valid number.',
            'duration.min' => 'Duration must be at least 1 minute.',

            'status.required' => 'Please select interview status.',
            'status.in' => 'Invalid interview status.',
        ]);

        $loggedInUserId = (int) session('id');

        $interview = Interview::create([
            'title' => trim($validated['title']),

            'description' => isset($validated['description'])
                ? trim($validated['description'])
                : null,

            'instructions' => isset($validated['instructions'])
                ? trim($validated['instructions'])
                : null,

            'duration' => $validated['duration'] ?? null,

            'status' => $validated['status'],

            'is_active' => $request->boolean('is_active'),

            'created_by' => $loggedInUserId,
        ]);

        return redirect()
            ->route('admin.interviews.index')
            ->with('success', 'Interview created successfully.');
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'min:3', 'max:255'],
            'description' => ['nullable', 'string'],
            'instructions' => ['nullable', 'string'],
            'duration' => ['nullable', 'integer', 'min:1'],
            'status' => ['required', 'in:draft,published,closed'],
            'is_active' => ['nullable', 'boolean'],
        ], [
            'title.required' => 'Interview title is required.',
            'title.min' => 'Interview title must be at least 3 characters.',
            'title.max' => 'Interview title cannot exceed 255 characters.',
            'duration.integer' => 'Duration must be a valid number.',
            'duration.min' => 'Duration must be at least 1 minute.',
            'status.required' => 'Please select interview status.',
            'status.in' => 'Invalid interview status.',
        ]);

        $loggedInUserId = (int) session('id');

        $interview = Interview::query()
            ->where('id', $id)
            ->where('created_by', $loggedInUserId)
            ->where('is_active', 1)
            ->first();

        if (!$interview) {
            return redirect()
                ->route('admin.interviews.index')
                ->with('error', 'Interview not found.');
        }

        $interview->update([
            'title' => trim($validated['title']),
            'description' => isset($validated['description'])
                ? trim($validated['description'])
                : null,
            'instructions' => isset($validated['instructions'])
                ? trim($validated['instructions'])
                : null,
            'duration' => $validated['duration'] ?? null,
            'status' => $validated['status'],
            'is_active' => $request->boolean('is_active'),
        ]);

        return redirect()
            ->route('admin.interviews.index')
            ->with('success', 'Interview updated successfully.');
    }

    public function destroy($id)
    {
        $loggedInUserId = (int) session('id');

        $interview = Interview::query()
            ->where('id', $id)
            ->where('created_by', $loggedInUserId)
            ->where('is_active', 1)
            ->first();

        if (!$interview) {
            return redirect()
                ->route('admin.interviews.index')
                ->with('error', 'Interview not found.');
        }

        $interview->delete();

        return redirect()
            ->route('admin.interviews.index')
            ->with('success', 'Interview deleted successfully.');
    }
}
