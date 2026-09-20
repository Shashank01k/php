<?php

namespace App\Http\Controllers\Web\V1\Admin;

use App\Http\Controllers\Controller;
use App\Models\Interview;
use App\Models\InterviewQuestion;
use App\Models\InterviewQuestionOption;
use Illuminate\Http\Request;

class InterviewQuestionController extends Controller
{
    public function index($interviewId)
    {
        $loggedInUserId = (int) session('id');

        $interview = Interview::query()
            ->where('id', $interviewId)
            ->where('created_by', $loggedInUserId)
            ->where('is_active', 1)
            ->first();
        // dd($interview);

        if (!$interview) {
            return redirect()
                ->route('admin.interviews.index')
                ->with('error', 'Interview not found.');
        }

        $perPage = 5;
        $page = 1;

        $offset = ($page - 1) * $perPage;

        $total = InterviewQuestion::query()
            ->where('interview_id', $interviewId)
            ->where('is_active', 1)
            ->count();

        //TODO:remove this
        // dd($total);

        $questions = InterviewQuestion::query()
            ->withCount('options')
            ->where('interview_id', $interviewId)
            ->where('is_active', 1)
            ->orderBy('question_order', 'asc')
            ->offset($offset)
            ->limit($perPage)
            ->get();

        //TODO:remove this
        // dd($questions);

        return view('admin.interviews.questions.index', [
            'title' => 'Interview Questions',
            'interview' => $interview,
            'questions' => $questions,
            'total' => $total,
            'page' => $page,
            'perPage' => $perPage,
        ]);
    }

    public function create($interviewId)
    {
        $loggedInUserId = (int) session('id');

        $interview = Interview::query()
            ->where('id', $interviewId)
            ->where('created_by', $loggedInUserId)
            ->where('is_active', 1)
            ->first();

        if (!$interview) {
            return redirect()
                ->route('admin.interviews.index')
                ->with('error', 'Interview not found.');
        }

        return view('admin.interviews.questions.create', [
            'title' => 'Add Question',
            'interview' => $interview,
        ]);
    }

    public function store(Request $request, $interviewId)
    {
        $loggedInUserId = (int) session('id');

        $interview = Interview::query()
            ->where('id', $interviewId)
            ->where('created_by', $loggedInUserId)
            ->where('is_active', 1)
            ->first();

        if (!$interview) {
            return redirect()
                ->route('admin.interviews.index')
                ->with('error', 'Interview not found.');
        }

        $validated = $request->validate([
            'question_type' => ['required', 'in:mcq,paragraph,media'],
            'question' => ['required', 'string'],
            'instructions' => ['nullable', 'string'],

            'answer_type' => [
                'nullable',
                'required_if:question_type,paragraph',
                'in:short,long',
            ],

            'media_type' => [
                'nullable',
                'required_if:question_type,media',
                'in:audio,video,image',
            ],

            'max_file_size' => [
                'nullable',
                'integer',
                'min:1',
            ],

            'question_order' => [
                'nullable',
                'integer',
                'min:0',
            ],

            'marks' => [
                'nullable',
                'numeric',
                'min:0',
            ],

            'options' => [
                'nullable',
                'array',
            ],

            'options.*.option_key' => [
                'required',
                'string',
                'max:10',
            ],

            'options.*.option_text' => [
                'required',
                'string',
            ],

            'correct_option' => [
                'nullable',
                'integer',
            ],
        ]);

        /*
        * MCQ validation
        */
        if ($validated['question_type'] === 'mcq') {

            if (empty($validated['options']) || count($validated['options']) < 2) {
                return back()
                    ->withInput()
                    ->withErrors([
                        'options' => 'MCQ must have at least 2 options.',
                    ]);
            }

            if (!isset($validated['correct_option'])) {
                return back()
                    ->withInput()
                    ->withErrors([
                        'correct_option' => 'Please select the correct answer.',
                    ]);
            }

            if (
                !isset($validated['options'][$validated['correct_option']])
            ) {
                return back()
                    ->withInput()
                    ->withErrors([
                        'correct_option' => 'Invalid correct answer selected.',
                    ]);
            }
        }

        /*
        * Create question
        */
        $question = InterviewQuestion::create([
            'interview_id' => $interview->id,
            'question_type' => $validated['question_type'],
            'question' => trim($validated['question']),
            'answer_type' => $validated['question_type'] === 'paragraph'
                ? ($validated['answer_type'] ?? null)
                : null,
            'media_type' => $validated['question_type'] === 'media'
                ? ($validated['media_type'] ?? null)
                : null,
            'instructions' => isset($validated['instructions'])
                ? trim($validated['instructions'])
                : null,
            'max_file_size' => $validated['question_type'] === 'media'
                ? ($validated['max_file_size'] ?? null)
                : null,
            'question_order' => $validated['question_order'] ?? 0,
            'marks' => $validated['marks'] ?? 0,
            'is_required' => $request->boolean('is_required'),
            'is_active' => $request->boolean('is_active'),
            'created_by' => $loggedInUserId,
        ]);

        /*
        * Save MCQ options
        */
        if (
            $question->question_type === 'mcq' &&
            !empty($validated['options'])
        ) {
            foreach ($validated['options'] as $index => $option) {

                InterviewQuestionOption::create([
                    'question_id' => $question->id,
                    'option_key' => $option['option_key'],
                    'option_text' => trim($option['option_text']),
                    'is_correct' => (
                        (int) $validated['correct_option'] === $index
                    ) ? 1 : 0,
                    'option_order' => $index,
                ]);
            }
        }

        return redirect()
            ->route(
                'admin.interviews.questions.index',
                $interview->id
            )
            ->with('success', 'Question added successfully.');
    }

    public function edit($interviewId, $questionId)
    {
        $loggedInUserId = (int) session('id');

        $interview = Interview::query()
            ->where('id', $interviewId)
            ->where('created_by', $loggedInUserId)
            ->where('is_active', 1)
            ->first();

        if (!$interview) {
            return redirect()
                ->route('admin.interviews.index')
                ->with('error', 'Interview not found.');
        }

        $question = InterviewQuestion::query()
            ->with('options')
            ->where('id', $questionId)
            ->where('interview_id', $interviewId)
            ->where('created_by', $loggedInUserId)
            ->where('is_active', 1)
            ->first();

        if (!$question) {
            return redirect()
                ->route(
                    'admin.interviews.questions.index',
                    $interviewId
                )
                ->with('error', 'Question not found.');
        }

        return view('admin.interviews.questions.edit', [
            'title' => 'Edit Question',
            'interview' => $interview,
            'question' => $question,
        ]);
    }

    public function update(Request $request, $interviewId, $questionId)
    {
        $loggedInUserId = (int) session('id');

        $interview = Interview::query()
            ->where('id', $interviewId)
            ->where('created_by', $loggedInUserId)
            ->where('is_active', 1)
            ->first();

        if (!$interview) {
            return redirect()
                ->route('admin.interviews.index')
                ->with('error', 'Interview not found.');
        }

        $question = InterviewQuestion::query()
            ->where('id', $questionId)
            ->where('interview_id', $interviewId)
            ->where('created_by', $loggedInUserId)
            ->where('is_active', 1)
            ->first();

        if (!$question) {
            return redirect()
                ->route(
                    'admin.interviews.questions.index',
                    $interviewId
                )
                ->with('error', 'Question not found.');
        }

        $validated = $request->validate([
            'question_type' => ['required', 'in:mcq,paragraph,media'],
            'question' => ['required', 'string'],
            'instructions' => ['nullable', 'string'],

            'answer_type' => [
                'nullable',
                'required_if:question_type,paragraph',
                'in:short,long',
            ],

            'media_type' => [
                'nullable',
                'required_if:question_type,media',
                'in:audio,video,image',
            ],

            'max_file_size' => [
                'nullable',
                'integer',
                'min:1',
            ],

            'question_order' => [
                'nullable',
                'integer',
                'min:0',
            ],

            'marks' => [
                'nullable',
                'numeric',
                'min:0',
            ],

            'options' => [
                'nullable',
                'array',
            ],

            'options.*.option_key' => [
                'required',
                'string',
                'max:10',
            ],

            'options.*.option_text' => [
                'required',
                'string',
            ],

            'correct_option' => [
                'nullable',
                'integer',
            ],
        ]);

        /*
        * MCQ validation
        */
        if ($validated['question_type'] === 'mcq') {

            if (empty($validated['options']) || count($validated['options']) < 2) {
                return back()
                    ->withInput()
                    ->withErrors([
                        'options' => 'MCQ must have at least 2 options.',
                    ]);
            }

            if (!isset($validated['correct_option'])) {
                return back()
                    ->withInput()
                    ->withErrors([
                        'correct_option' => 'Please select the correct answer.',
                    ]);
            }

            if (!isset($validated['options'][$validated['correct_option']])) {
                return back()
                    ->withInput()
                    ->withErrors([
                        'correct_option' => 'Invalid correct answer selected.',
                    ]);
            }
        }

        /*
        * Update question
        */
        $question->update([
            'question_type' => $validated['question_type'],
            'question' => trim($validated['question']),
            'answer_type' => $validated['question_type'] === 'paragraph'
                ? ($validated['answer_type'] ?? null)
                : null,
            'media_type' => $validated['question_type'] === 'media'
                ? ($validated['media_type'] ?? null)
                : null,
            'instructions' => isset($validated['instructions'])
                ? trim($validated['instructions'])
                : null,
            'max_file_size' => $validated['question_type'] === 'media'
                ? ($validated['max_file_size'] ?? null)
                : null,
            'question_order' => $validated['question_order'] ?? 0,
            'marks' => $validated['marks'] ?? 0,
            'is_required' => $request->boolean('is_required'),
            'is_active' => $request->boolean('is_active'),
        ]);

        /*
        * Update MCQ options
        */
        if ($question->question_type === 'mcq') {

            $question->options()->delete();

            foreach ($validated['options'] as $index => $option) {

                InterviewQuestionOption::create([
                    'question_id' => $question->id,
                    'option_key' => $option['option_key'],
                    'option_text' => trim($option['option_text']),
                    'is_correct' => (
                        (int) $validated['correct_option'] === $index
                    ) ? 1 : 0,
                    'option_order' => $index,
                ]);
            }

        } else {

            // Remove old MCQ options if question type changed.
            $question->options()->delete();
        }

        return redirect()
            ->route(
                'admin.interviews.questions.index',
                $interviewId
            )
            ->with('success', 'Question updated successfully.');
    }
}
