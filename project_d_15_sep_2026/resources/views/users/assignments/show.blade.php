@extends('layouts.main')

@section('title', $title ?? 'Assignment Details')

@section('content')

<div class="container-fluid py-4">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h4 class="mb-1">
                Assignment Details
            </h4>
        </div>

        <a href="{{ route('users.assignments.index') }}"
           class="btn btn-secondary">
            Back
        </a>

    </div>

    @include('components.flash_alert_message')

    <div class="card shadow-sm">

        <div class="card-body">

            <h3 class="mb-3">
                {{ $assignment->title }}
            </h3>

            <div class="row mb-3">

                <div class="col-md-6">
                    <strong>Technology:</strong>

                    {{ $assignment->technology ?: '-' }}
                </div>

                <div class="col-md-6">
                    <strong>Priority:</strong>

                    {{ ucfirst($assignment->priority) }}
                </div>

            </div>

            <div class="row mb-3">

                <div class="col-md-6">
                    <strong>Status:</strong>

                    {{ ucwords(str_replace(
                        '_',
                        ' ',
                        $assignment->status
                    )) }}
                </div>

                <div class="col-md-6">
                    <strong>Due Date:</strong>

                    {{ $assignment->due_date
                        ? \Carbon\Carbon::parse($assignment->due_date)->format('d M Y')
                        : '-' }}
                </div>

            </div>

            <hr>

            <h5>
                Description
            </h5>

            <div class="mt-3">
                {!! nl2br(e($assignment->description)) !!}
            </div>

            <hr>

            <div class="mt-4">

                @if ($assignment->status === 'pending')

                    <form
                        method="POST"
                        action="{{ route(
                            'users.assignments.start',
                            $assignment->id
                        ) }}"
                    >

                        @csrf

                        <button type="submit"
                                class="btn btn-primary">
                            Start Assignment
                        </button>

                    </form>

                @elseif ($assignment->status === 'in_progress')

                    <span class="badge bg-primary p-2">
                        Assignment In Progress
                    </span>

                @elseif ($assignment->status === 'completed')

                    <span class="badge bg-success p-2">
                        Assignment Completed
                    </span>

                @elseif ($assignment->status === 'cancelled')

                    <span class="badge bg-danger p-2">
                        Assignment Cancelled
                    </span>

                @endif

            </div>

        </div>

    </div>

</div>

@endsection