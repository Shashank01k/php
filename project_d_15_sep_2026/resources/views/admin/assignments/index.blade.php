@extends('layouts.main')

@section('title', 'All Assignments')

@section('content')

<style>
    .assignment-pagination .pagination {
        gap: 6px !important;
    }
</style>

<div class="container-fluid py-4">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">

        <h4 class="mb-0">
            <i class="fa fa-tasks me-2"></i>
            All Assignments
        </h4>

        <a
            href="{{ route('admin.assignments.create.form') }}"
            class="btn btn-primary"
        >
            <i class="fa fa-plus me-1"></i>
            Add Assignment
        </a>

    </div>


    {{-- Success Message | Error Message --}}
    @include('components.flash_alert_message')


    {{-- Assignment Cards --}}
    @if ($assignments->isNotEmpty())

        <div class="row g-4">

            @foreach ($assignments as $assignment)

                <div class="col-xl-4 col-lg-6 col-md-6">

                    <div class="card shadow-sm h-100">

                        {{-- Card Header --}}
                        <div class="card-header d-flex justify-content-between align-items-center">

                            <h5 class="mb-0">
                                {{ $assignment->title }}
                            </h5>

                            @php
                                $statusClass = match ($assignment->status) {
                                    'pending' => 'bg-warning text-dark',
                                    'in_progress' => 'bg-primary',
                                    'completed' => 'bg-success',
                                    'cancelled' => 'bg-danger',
                                    default => 'bg-secondary',
                                };
                            @endphp

                            <span class="badge {{ $statusClass }}">
                                {{ ucwords(str_replace('_', ' ', $assignment->status)) }}
                            </span>

                        </div>


                        {{-- Card Body --}}
                        <div class="card-body">

                            {{-- Description --}}
                            <p class="text-muted mb-3">
                                {{ $assignment->description ?? '-' }}
                            </p>


                            {{-- Details --}}
                            <div class="small">

                                <div class="mb-2">
                                    <strong>
                                        <i class="fa fa-code me-1"></i>
                                        Technology:
                                    </strong>

                                    {{ $assignment->technology ?? '-' }}
                                </div>


                                <div class="mb-2">
                                    <strong>
                                        <i class="fa fa-user me-1"></i>
                                        Assigned To:
                                    </strong>

                                    {{ $assignment->assigned_user_name ?? '-' }}
                                </div>


                                <div class="mb-2">
                                    <strong>
                                        <i class="fa fa-flag me-1"></i>
                                        Priority:
                                    </strong>

                                    {{ ucfirst($assignment->priority) }}
                                </div>


                                <div class="mb-2">
                                    <strong>
                                        <i class="fa fa-calendar me-1"></i>
                                        Due Date:
                                    </strong>

                                    {{ !empty($assignment->due_date)
                                        ? $assignment->due_date
                                        : '-' }}
                                </div>


                                <div>
                                    <strong>
                                        <i class="fa fa-clock-o me-1"></i>
                                        Created:
                                    </strong>

                                    {{ !empty($assignment->created_at)
                                        ? $assignment->created_at->format('d M Y')
                                        : '-' }}
                                </div>

                            </div>

                        </div>


                        {{-- Card Footer --}}
                        <div class="card-footer bg-white">

                            <div class="d-flex justify-content-end gap-2">

                                {{-- Edit --}}
                                <a
                                    href="{{ route('admin.assignments.edit', $assignment->id) }}"
                                    class="btn btn-sm btn-outline-primary"
                                >
                                    <i class="fa fa-edit me-1"></i>
                                    Edit
                                </a>


                                {{-- Delete --}}
                                <form
                                    action="{{ route('admin.assignments.destroy', $assignment->id) }}"
                                    method="POST"
                                    onsubmit="return confirm('Are you sure you want to delete this assignment?');"
                                >

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="btn btn-sm btn-outline-danger"
                                    >
                                        <i class="fa fa-trash me-1"></i>
                                        Delete
                                    </button>

                                </form>

                            </div>

                        </div>

                    </div>

                </div>

            @endforeach

        </div>

        {{-- Pagination --}}
        @if ($assignments->lastPage() > 1)

            @php
                $currentPage = $assignments->currentPage();
                $lastPage = $assignments->lastPage();

                $startPage = max(1, $currentPage - 2);
                $endPage = min($lastPage, $currentPage + 2);
            @endphp

            <div class="d-flex justify-content-center mt-4 assignment-pagination">

                <nav aria-label="Assignment pagination">

                    <ul class="pagination mb-0">

                        {{-- First Page --}}
                        @if ($startPage > 1)

                            <li class="page-item">
                                <a
                                    class="page-link"
                                    href="{{ $assignments->url(1) }}"
                                >
                                    1
                                </a>
                            </li>

                            @if ($startPage > 2)
                                <li class="page-item disabled">
                                    <span class="page-link">...</span>
                                </li>
                            @endif

                        @endif


                        {{-- Page Numbers --}}
                        @for ($page = $startPage; $page <= $endPage; $page++)

                            <li class="page-item {{ $currentPage == $page ? 'active' : '' }}">

                                <a
                                    class="page-link"
                                    href="{{ $assignments->url($page) }}"
                                >
                                    {{ $page }}
                                </a>

                            </li>

                        @endfor


                        {{-- Last Page --}}
                        @if ($endPage < $lastPage)

                            @if ($endPage < $lastPage - 1)
                                <li class="page-item disabled">
                                    <span class="page-link">...</span>
                                </li>
                            @endif

                            <li class="page-item">
                                <a
                                    class="page-link"
                                    href="{{ $assignments->url($lastPage) }}"
                                >
                                    {{ $lastPage }}
                                </a>
                            </li>

                        @endif

                    </ul>

                </nav>

            </div>

        @endif

        {{-- Count --}}
        @php
            $currentPage = $assignments->currentPage();
            $perPage = $assignments->perPage();
            $total = $assignments->total();

            $start = (($currentPage - 1) * $perPage) + 1;
            $end = min($currentPage * $perPage, $total);
        @endphp

        <div class="text-muted text-center mt-2">

            @if ($total > 0)

                Showing {{ $start }}
                to {{ $end }}
                of {{ $total }} assignments

            @endif

        </div>


    @else

        <div class="card shadow-sm">

            <div class="card-body text-center py-5">

                <i class="fa fa-tasks fa-3x text-muted mb-3"></i>

                <h5>No assignments found</h5>

                <p class="text-muted">
                    There are currently no active assignments.
                </p>

                <a
                    href="{{ route('admin.assignments.create.form') }}"
                    class="btn btn-primary"
                >
                    <i class="fa fa-plus me-1"></i>
                    Add Assignment
                </a>

            </div>

        </div>

    @endif

</div>

@endsection