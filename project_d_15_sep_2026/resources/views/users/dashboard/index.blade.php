@extends('layouts.main')

@section('title', 'User Dashboard')

@section('content')

<div class="container-fluid py-4">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h4 class="mb-1">
                Welcome, {{ session('firstname') }}
            </h4>

            <p class="text-muted mb-0">
                Here's an overview of your account and assignments.
            </p>
        </div>

    </div>


    {{-- Flash Messages --}}
    @include('components.flash_alert_message')


    {{-- Main Metrics --}}
    <div class="row g-4 mb-4">

        {{-- Total Assignments --}}
        <div class="col-xl-3 col-md-6">

            <div class="card border-0 shadow-sm h-100">

                <div class="card-body">

                    <div class="d-flex justify-content-between align-items-center">

                        <div>
                            <p class="text-muted mb-1">
                                Total Assignments
                            </p>

                            <h3 class="mb-0">
                                {{ $totalAssignments ?? 0 }}
                            </h3>
                        </div>

                        <div class="fs-1 text-primary">
                            <i class="fa fa-tasks"></i>
                        </div>

                    </div>

                    <div class="mt-3">
                        <a href="{{ route('users.assignments.index') }}"
                           class="btn btn-sm btn-outline-primary">
                            View All
                            <i class="fa fa-arrow-right ms-1"></i>
                        </a>
                    </div>

                </div>

            </div>

        </div>


        {{-- Pending --}}
        <div class="col-xl-3 col-md-6">

            <div class="card border-0 shadow-sm h-100">

                <div class="card-body">

                    <div class="d-flex justify-content-between align-items-center">

                        <div>
                            <p class="text-muted mb-1">
                                Pending
                            </p>

                            <h3 class="mb-0">
                                {{ $pendingAssignments ?? 0 }}
                            </h3>
                        </div>

                        <div class="fs-1 text-warning">
                            <i class="fa fa-clock-o"></i>
                        </div>

                    </div>

                    <div class="mt-3">
                        <a href="{{ route('users.assignments.index', ['status' => 'pending']) }}"
                           class="btn btn-sm btn-outline-warning">
                            View Pending
                            <i class="fa fa-arrow-right ms-1"></i>
                        </a>
                    </div>

                </div>

            </div>

        </div>


        {{-- In Progress --}}
        <div class="col-xl-3 col-md-6">

            <div class="card border-0 shadow-sm h-100">

                <div class="card-body">

                    <div class="d-flex justify-content-between align-items-center">

                        <div>
                            <p class="text-muted mb-1">
                                In Progress
                            </p>

                            <h3 class="mb-0">
                                {{ $inProgressAssignments ?? 0 }}
                            </h3>
                        </div>

                        <div class="fs-1 text-info">
                            <i class="fa fa-spinner"></i>
                        </div>

                    </div>

                    <div class="mt-3">
                        <a href="{{ route('users.assignments.index', ['status' => 'in_progress']) }}"
                           class="btn btn-sm btn-outline-info">
                            Continue
                            <i class="fa fa-arrow-right ms-1"></i>
                        </a>
                    </div>

                </div>

            </div>

        </div>


        {{-- Completed --}}
        <div class="col-xl-3 col-md-6">

            <div class="card border-0 shadow-sm h-100">

                <div class="card-body">

                    <div class="d-flex justify-content-between align-items-center">

                        <div>
                            <p class="text-muted mb-1">
                                Completed
                            </p>

                            <h3 class="mb-0">
                                {{ $completedAssignments ?? 0 }}
                            </h3>
                        </div>

                        <div class="fs-1 text-success">
                            <i class="fa fa-check-circle"></i>
                        </div>

                    </div>

                    <div class="mt-3">
                        <a href="{{ route('users.assignments.index', ['status' => 'completed']) }}"
                           class="btn btn-sm btn-outline-success">
                            View Completed
                            <i class="fa fa-arrow-right ms-1"></i>
                        </a>
                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- Assignment Overview --}}
    <div class="row g-4 mb-4">

        {{-- Progress --}}
        <div class="col-lg-8">

            <div class="card border-0 shadow-sm h-100">

                <div class="card-body">

                    <div class="d-flex justify-content-between align-items-center mb-3">

                        <div>
                            <h5 class="mb-1">
                                Assignment Progress
                            </h5>

                            <small class="text-muted">
                                Your overall assignment completion
                            </small>
                        </div>

                        <i class="fa fa-bar-chart fs-3 text-primary"></i>

                    </div>


                    @php
                        $total = $totalAssignments ?? 0;
                        $completed = $completedAssignments ?? 0;

                        $completionPercentage = $total > 0
                            ? round(($completed / $total) * 100)
                            : 0;
                    @endphp


                    <div class="d-flex justify-content-between mb-2">

                        <span>
                            Completion
                        </span>

                        <strong>
                            {{ $completionPercentage }}%
                        </strong>

                    </div>


                    <div class="progress" style="height: 10px;">

                        <div
                            class="progress-bar bg-success"
                            role="progressbar"
                            style="width: {{ $completionPercentage }}%;"
                            aria-valuenow="{{ $completionPercentage }}"
                            aria-valuemin="0"
                            aria-valuemax="100">
                        </div>

                    </div>


                    <div class="row text-center mt-4">

                        <div class="col-4">

                            <h5 class="mb-1">
                                {{ $pendingAssignments ?? 0 }}
                            </h5>

                            <small class="text-muted">
                                Pending
                            </small>

                        </div>


                        <div class="col-4">

                            <h5 class="mb-1">
                                {{ $inProgressAssignments ?? 0 }}
                            </h5>

                            <small class="text-muted">
                                In Progress
                            </small>

                        </div>


                        <div class="col-4">

                            <h5 class="mb-1">
                                {{ $completedAssignments ?? 0 }}
                            </h5>

                            <small class="text-muted">
                                Completed
                            </small>

                        </div>

                    </div>


                    <div class="mt-4">

                        <a href="{{ route('users.assignments.index') }}"
                           class="btn btn-primary">

                            <i class="fa fa-list me-1"></i>
                            View All Assignments

                        </a>

                    </div>

                </div>

            </div>

        </div>


        {{-- Quick Actions --}}
        <div class="col-lg-4">

            <div class="card border-0 shadow-sm h-100">

                <div class="card-body">

                    <h5 class="mb-1">
                        Quick Actions
                    </h5>

                    <p class="text-muted mb-4">
                        Frequently used options
                    </p>


                    <div class="d-grid gap-2">

                        <a href="{{ route('users.assignments.index') }}"
                           class="btn btn-outline-primary text-start">

                            <i class="fa fa-tasks me-2"></i>
                            My Assignments

                            <i class="fa fa-arrow-right float-end mt-1"></i>

                        </a>


                        <a href="{{ route('users.profile.edit', session('id')) }}"
                           class="btn btn-outline-secondary text-start">

                            <i class="fa fa-user me-2"></i>
                            My Profile

                            <i class="fa fa-arrow-right float-end mt-1"></i>

                        </a>

                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- Recent Assignments --}}
    <div class="card border-0 shadow-sm">

        <div class="card-body">

            <div class="d-flex justify-content-between align-items-center mb-3">

                <div>
                    <h5 class="mb-1">
                        Recent Assignments
                    </h5>

                    <small class="text-muted">
                        Your latest assigned work
                    </small>
                </div>

                <a href="{{ route('users.assignments.index') }}"
                   class="btn btn-sm btn-outline-primary">

                    View All
                    <i class="fa fa-arrow-right ms-1"></i>

                </a>

            </div>


            @if (!empty($recentAssignments) && count($recentAssignments) > 0)

                <div class="table-responsive">

                    <table class="table table-hover align-middle mb-0">

                        <thead>

                            <tr>
                                <th>Assignment</th>
                                <th>Technology</th>
                                <th>Status</th>
                                <th>Priority</th>
                                <th>Due Date</th>
                                <th class="text-center">Action</th>
                            </tr>

                        </thead>

                        <tbody>

                            @foreach ($recentAssignments as $assignment)

                                <tr>

                                    <td>
                                        <strong>
                                            {{ $assignment->title }}
                                        </strong>
                                    </td>

                                    <td>
                                        {{ $assignment->technology ?: '-' }}
                                    </td>

                                    <td>

                                        @if ($assignment->status === 'pending')

                                            <span class="badge bg-secondary">
                                                Pending
                                            </span>

                                        @elseif ($assignment->status === 'in_progress')

                                            <span class="badge bg-primary">
                                                In Progress
                                            </span>

                                        @elseif ($assignment->status === 'completed')

                                            <span class="badge bg-success">
                                                Completed
                                            </span>

                                        @else

                                            <span class="badge bg-danger">
                                                Cancelled
                                            </span>

                                        @endif

                                    </td>

                                    <td>

                                        @if ($assignment->priority === 'high')

                                            <span class="badge bg-danger">
                                                High
                                            </span>

                                        @elseif ($assignment->priority === 'medium')

                                            <span class="badge bg-warning text-dark">
                                                Medium
                                            </span>

                                        @else

                                            <span class="badge bg-success">
                                                Low
                                            </span>

                                        @endif

                                    </td>

                                    <td>
                                        {{ $assignment->due_date
                                            ? \Carbon\Carbon::parse($assignment->due_date)->format('d M Y')
                                            : '-' }}
                                    </td>

                                    <td class="text-center">

                                        <a href="{{ route(
                                            'users.assignments.show',
                                            $assignment->id
                                        ) }}"
                                           class="btn btn-sm btn-primary">

                                            <i class="fa fa-eye"></i>
                                            View

                                        </a>

                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

            @else

                <div class="text-center py-5">

                    <i class="fa fa-tasks fs-1 text-muted mb-3"></i>

                    <h6>
                        No assignments yet
                    </h6>

                    <p class="text-muted mb-3">
                        Assignments assigned to you will appear here.
                    </p>

                    <a href="{{ route('users.assignments.index') }}"
                       class="btn btn-primary">

                        View Assignments

                    </a>

                </div>

            @endif

        </div>

    </div>

</div>

@endsection