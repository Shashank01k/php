@extends('layouts.main')

@section('title', $title ?? 'Interview Details')

@section('content')

<div class="container-fluid py-4">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h4 class="mb-1">
                Interview Details
            </h4>

            <p class="text-muted mb-0">
                View interview information.
            </p>
        </div>

        <div class="d-flex gap-2">

            <a
                href="{{ route('admin.interviews.edit', $interview->id) }}"
                class="btn btn-warning"
            >

                <i class="fa fa-edit"></i>
                Edit

            </a>

            <a
                href="{{ route('admin.interviews.index') }}"
                class="btn btn-secondary"
            >

                <i class="fa fa-arrow-left"></i>
                Back

            </a>

        </div>

    </div>


    {{-- Success --}}
    @if (session('success'))

        <div class="alert alert-success alert-dismissible fade show">

            {{ session('success') }}

            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert">
            </button>

        </div>

    @endif


    {{-- Main Interview Information --}}
    <div class="card shadow-sm mb-4">

        <div class="card-header bg-white">

            <div class="d-flex justify-content-between align-items-center">

                <h5 class="mb-0">
                    {{ $interview->title }}
                </h5>


                @if ($interview->status === 'published')

                    <span class="badge bg-success">
                        Published
                    </span>

                @elseif ($interview->status === 'closed')

                    <span class="badge bg-secondary">
                        Closed
                    </span>

                @else

                    <span class="badge bg-warning text-dark">
                        Draft
                    </span>

                @endif

            </div>

        </div>


        <div class="card-body">

            <div class="row">

                {{-- Description --}}
                <div class="col-md-8 mb-4">

                    <label class="text-muted small">
                        Description
                    </label>

                    <div class="mt-1">

                        @if ($interview->description)

                            {!! nl2br(e($interview->description)) !!}

                        @else

                            <span class="text-muted">
                                No description provided.
                            </span>

                        @endif

                    </div>

                </div>


                {{-- Duration --}}
                <div class="col-md-4 mb-4">

                    <label class="text-muted small">
                        Duration
                    </label>

                    <div class="mt-1">

                        @if ($interview->duration)

                            <strong>
                                {{ $interview->duration }} Minutes
                            </strong>

                        @else

                            <span class="text-muted">
                                Not specified
                            </span>

                        @endif

                    </div>

                </div>


                {{-- Instructions --}}
                <div class="col-md-12 mb-4">

                    <label class="text-muted small">
                        Instructions
                    </label>

                    <div class="mt-1">

                        @if ($interview->instructions)

                            {!! nl2br(e($interview->instructions)) !!}

                        @else

                            <span class="text-muted">
                                No instructions provided.
                            </span>

                        @endif

                    </div>

                </div>


                {{-- Active Status --}}
                <div class="col-md-4">

                    <label class="text-muted small">
                        Active
                    </label>

                    <div class="mt-1">

                        @if ($interview->is_active)

                            <span class="badge bg-success">
                                Active
                            </span>

                        @else

                            <span class="badge bg-danger">
                                Inactive
                            </span>

                        @endif

                    </div>

                </div>


                {{-- Created --}}
                <div class="col-md-4">

                    <label class="text-muted small">
                        Created On
                    </label>

                    <div class="mt-1">

                        {{ $interview->created_at?->format('d M Y, h:i A') }}

                    </div>

                </div>


                {{-- Updated --}}
                <div class="col-md-4">

                    <label class="text-muted small">
                        Last Updated
                    </label>

                    <div class="mt-1">

                        {{ $interview->updated_at?->format('d M Y, h:i A') }}

                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- Questions Section --}}
    <div class="card shadow-sm">

        <div class="card-header bg-white">

            <div class="d-flex justify-content-between align-items-center">

                <div>

                    <h5 class="mb-1">
                        Interview Questions
                    </h5>

                    <small class="text-muted">
                        Manage questions for this interview.
                    </small>

                </div>

                <a
                    href="{{ route('admin.interviews.questions.index', $interview->id) }}"
                    class="btn btn-primary"
                >

                    <i class="fa fa-question-circle"></i>
                    Manage Questions

                </a>

            </div>

        </div>


        <div class="card-body">

            @php
                $questionCount = $interview->questions_count
                    ?? ($interview->questions?->count() ?? 0);
            @endphp


            <div class="row text-center">

                <div class="col-md-4">

                    <div class="border rounded p-4">

                        <i class="fa fa-question-circle fa-2x text-primary mb-2"></i>

                        <h4 class="mb-1">
                            {{ $questionCount }}
                        </h4>

                        <span class="text-muted">
                            Total Questions
                        </span>

                    </div>

                </div>


                <div class="col-md-4">

                    <div class="border rounded p-4">

                        <i class="fa fa-check-square-o fa-2x text-success mb-2"></i>

                        <h4 class="mb-1">
                            -
                        </h4>

                        <span class="text-muted">
                            MCQ Questions
                        </span>

                    </div>

                </div>


                <div class="col-md-4">

                    <div class="border rounded p-4">

                        <i class="fa fa-file-text-o fa-2x text-info mb-2"></i>

                        <h4 class="mb-1">
                            -
                        </h4>

                        <span class="text-muted">
                            Other Questions
                        </span>

                    </div>

                </div>

            </div>


            <div class="text-center mt-4">

                <a
                    href="{{ route('admin.interviews.questions.index', $interview->id) }}"
                    class="btn btn-primary"
                >

                    <i class="fa fa-list"></i>
                    View / Manage Questions

                </a>

            </div>

        </div>

    </div>

</div>

@endsection