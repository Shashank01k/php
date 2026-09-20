@extends('layouts.main')

@section('title', $title ?? 'Interview Questions')

@section('content')

<div class="container-fluid py-4">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="mb-1">Interview Questions</h4>

            @if(isset($interview))
                <p class="text-muted mb-0">
                    Interview: <strong>{{ $interview->title }}</strong>
                </p>
            @endif
        </div>

        <div>
            <a href="{{ route('admin.interviews.show', $interview->id) }}"
               class="btn btn-secondary">
                <i class="fa fa-arrow-left"></i>
                Back
            </a>

            <a href="{{ route('admin.interviews.questions.create', $interview->id) }}"
               class="btn btn-primary">
                <i class="fa fa-plus"></i>
                Add Question
            </a>
        </div>
    </div>


    {{-- Success Message --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}

            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert"></button>
        </div>
    @endif


    {{-- Error Message --}}
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show">
            {{ session('error') }}

            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert"></button>
        </div>
    @endif


    {{-- Validation Errors --}}
    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    {{-- Questions Table --}}
    <div class="card shadow-sm">

        <div class="card-header">
            <strong>Questions</strong>
        </div>

        <div class="card-body p-0">

            @if($questions->count())

                <div class="table-responsive">

                    <table class="table table-bordered table-hover mb-0">

                        <thead>
                            <tr>
                                <th width="60">#</th>
                                <th>Question</th>
                                <th width="120">Type</th>
                                <th width="120">Answer / Media</th>
                                <th width="100">Marks</th>
                                <th width="100">Required</th>
                                <th width="100">Status</th>
                                <th width="180">Action</th>
                            </tr>
                        </thead>

                        <tbody>

                            @foreach($questions as $key => $question)

                                <tr>

                                    <td>
                                        {{ (($page - 1) * $perPage) + $key + 1 }}
                                    </td>

                                    <td>
                                        {{ $question->question }}
                                    </td>

                                    <td>
                                        @if($question->question_type === 'mcq')
                                            <span class="badge bg-primary">
                                                MCQ
                                            </span>
                                        @elseif($question->question_type === 'paragraph')
                                            <span class="badge bg-info">
                                                Paragraph
                                            </span>
                                        @elseif($question->question_type === 'media')
                                            <span class="badge bg-warning text-dark">
                                                Media
                                            </span>
                                        @endif
                                    </td>

                                    <td>

                                        @if($question->question_type === 'paragraph')
                                            {{ ucfirst($question->answer_type ?? '-') }}

                                        @elseif($question->question_type === 'media')
                                            {{ ucfirst($question->media_type ?? '-') }}

                                        @else
                                            {{ $question->options_count ?? 0 }} Options
                                        @endif

                                    </td>

                                    <td>
                                        {{ $question->marks }}
                                    </td>

                                    <td>
                                        @if($question->is_required)
                                            <span class="badge bg-success">
                                                Yes
                                            </span>
                                        @else
                                            <span class="badge bg-secondary">
                                                No
                                            </span>
                                        @endif
                                    </td>

                                    <td>
                                        @if($question->is_active)
                                            <span class="badge bg-success">
                                                Active
                                            </span>
                                        @else
                                            <span class="badge bg-secondary">
                                                Inactive
                                            </span>
                                        @endif
                                    </td>

                                    <td>

                                        <a href="{{ route(
                                            'admin.interviews.questions.edit',
                                            [
                                                'interviewId' => $interview->id,
                                                'questionId' => $question->id
                                            ]
                                        ) }}"
                                           class="btn btn-sm btn-warning">
                                            <i class="fa fa-edit"></i>
                                            Edit
                                        </a>

                                        <form action="{{ route(
                                            'admin.interviews.questions.destroy',
                                            [
                                                'interviewId' => $interview->id,
                                                'questionId' => $question->id
                                            ]
                                        ) }}"
                                              method="POST"
                                              class="d-inline"
                                              onsubmit="return confirm('Are you sure you want to delete this question?');">

                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                    class="btn btn-sm btn-danger">
                                                <i class="fa fa-trash"></i>
                                                Delete
                                            </button>

                                        </form>

                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

            @else

                <div class="text-center py-5">

                    <i class="fa fa-question-circle fa-3x text-muted mb-3"></i>

                    <h5>No Questions Found</h5>

                    <p class="text-muted">
                        No questions have been added to this interview yet.
                    </p>

                    <a href="{{ route(
                        'admin.interviews.questions.create',
                        $interview->id
                    ) }}"
                       class="btn btn-primary">

                        <i class="fa fa-plus"></i>
                        Add First Question

                    </a>

                </div>

            @endif

        </div>

    </div>

</div>

@endsection