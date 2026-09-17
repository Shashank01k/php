@extends('layouts.main')

@section('title', $title ?? 'My Assignments')

@section('content')

<div class="container-fluid py-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="mb-1">My Assignments</h4>
            <p class="text-muted mb-0">
                Assignments assigned to you
            </p>
        </div>
    </div>

    @include('components.flash_alert_message')

    {{-- Search / Filters --}}
    <div class="card mb-4">
        <div class="card-body">

            <form method="GET"
                  action="{{ route('users.assignments.index') }}">

                <div class="row g-3">

                    <div class="col-md-5">
                        <label class="form-label">
                            Search
                        </label>

                        <input
                            type="text"
                            name="search"
                            value="{{ $search }}"
                            class="form-control"
                            placeholder="Search assignment..."
                        >
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">
                            Status
                        </label>

                        <select name="status" class="form-select">
                            <option value="">All Status</option>

                            <option value="pending"
                                {{ $status === 'pending' ? 'selected' : '' }}>
                                Pending
                            </option>

                            <option value="in_progress"
                                {{ $status === 'in_progress' ? 'selected' : '' }}>
                                In Progress
                            </option>

                            <option value="completed"
                                {{ $status === 'completed' ? 'selected' : '' }}>
                                Completed
                            </option>

                            <option value="cancelled"
                                {{ $status === 'cancelled' ? 'selected' : '' }}>
                                Cancelled
                            </option>
                        </select>
                    </div>

                    <div class="col-md-2">
                        <label class="form-label">
                            Priority
                        </label>

                        <select name="priority" class="form-select">
                            <option value="">All Priority</option>

                            <option value="low"
                                {{ $priority === 'low' ? 'selected' : '' }}>
                                Low
                            </option>

                            <option value="medium"
                                {{ $priority === 'medium' ? 'selected' : '' }}>
                                Medium
                            </option>

                            <option value="high"
                                {{ $priority === 'high' ? 'selected' : '' }}>
                                High
                            </option>
                        </select>
                    </div>

                    <div class="col-md-2 d-flex align-items-end gap-2">

                        <button type="submit"
                                class="btn btn-primary">
                            Search
                        </button>

                        <a href="{{ route('users.assignments.index') }}"
                           class="btn btn-secondary">
                            Reset
                        </a>

                    </div>

                </div>

            </form>

        </div>
    </div>

    {{-- Assignment List --}}
    <div class="row">

        @forelse ($assignments as $assignment)

            <div class="col-lg-6 col-xl-4 mb-4">

                <div class="card h-100 shadow-sm">

                    <div class="card-body">

                        <div class="d-flex justify-content-between align-items-start mb-2">

                            <h5 class="card-title mb-0">
                                {{ $assignment->title }}
                            </h5>

                            <span class="badge
                                @if ($assignment->priority === 'high')
                                    bg-danger
                                @elseif ($assignment->priority === 'medium')
                                    bg-warning text-dark
                                @else
                                    bg-success
                                @endif
                            ">
                                {{ ucfirst($assignment->priority) }}
                            </span>

                        </div>

                        @if ($assignment->technology)
                            <div class="mb-2">
                                <small class="text-muted">
                                    Technology:
                                </small>

                                <strong>
                                    {{ $assignment->technology }}
                                </strong>
                            </div>
                        @endif

                        <p class="text-muted">
                            {{ \Illuminate\Support\Str::limit(
                                $assignment->description,
                                120
                            ) }}
                        </p>

                        <div class="mb-3">

                            <small class="text-muted">
                                Status:
                            </small>

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

                        </div>

                        @if ($assignment->due_date)

                            <div class="mb-3">
                                <small class="text-muted">
                                    Due Date:
                                </small>

                                <strong>
                                    {{ \Carbon\Carbon::parse($assignment->due_date)->format('d M Y') }}
                                </strong>
                            </div>

                        @endif

                        <div class="d-flex gap-2">

                            <a href="{{ route(
                                'users.assignments.show',
                                $assignment->id
                            ) }}"
                               class="btn btn-outline-primary">
                                View
                            </a>

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

                                <a href="{{ route(
                                    'users.assignments.show',
                                    $assignment->id
                                ) }}"
                                   class="btn btn-primary">
                                    Continue
                                </a>

                            @endif

                        </div>

                    </div>

                </div>

            </div>

        @empty

            <div class="col-12">

                <div class="alert alert-info text-center">
                    No assignments found.
                </div>

            </div>

        @endforelse

    </div>

    {{-- Pagination --}}
    @if ($assignments->lastPage() > 1)

        @php
            $currentPage = $assignments->currentPage();
            $lastPage = $assignments->lastPage();

            $startPage = max(1, $currentPage - 2);
            $endPage = min($lastPage, $currentPage + 2);
        @endphp

        <div class="d-flex justify-content-center mt-4">

            <nav aria-label="Assignment pagination">

                <ul class="pagination mb-0">

                    @if ($startPage > 1)

                        <li class="page-item">
                            <a class="page-link"
                               href="{{ $assignments->url(1) }}">
                                1
                            </a>
                        </li>

                        @if ($startPage > 2)
                            <li class="page-item disabled">
                                <span class="page-link">
                                    ...
                                </span>
                            </li>
                        @endif

                    @endif

                    @for ($page = $startPage; $page <= $endPage; $page++)

                        <li class="page-item
                            {{ $currentPage == $page ? 'active' : '' }}">

                            <a class="page-link"
                               href="{{ $assignments->url($page) }}">
                                {{ $page }}
                            </a>

                        </li>

                    @endfor

                    @if ($endPage < $lastPage)

                        @if ($endPage < $lastPage - 1)
                            <li class="page-item disabled">
                                <span class="page-link">
                                    ...
                                </span>
                            </li>
                        @endif

                        <li class="page-item">
                            <a class="page-link"
                               href="{{ $assignments->url($lastPage) }}">
                                {{ $lastPage }}
                            </a>
                        </li>

                    @endif

                </ul>

            </nav>

        </div>

    @endif

    {{-- Count --}}
    @if ($assignments->total() > 0)

        @php
            $start = (($assignments->currentPage() - 1)
                * $assignments->perPage()) + 1;

            $end = min(
                $assignments->currentPage() * $assignments->perPage(),
                $assignments->total()
            );
        @endphp

        <div class="text-muted text-center mt-2">

            Showing {{ $start }}
            to {{ $end }}
            of {{ $assignments->total() }}
            assignments

        </div>

    @endif

</div>

@endsection