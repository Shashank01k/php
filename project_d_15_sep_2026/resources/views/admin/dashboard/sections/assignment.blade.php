<div class="card shadow-sm">

    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">
            <i class="fa fa-tasks me-2"></i>
            Assignments
        </h5>

        <a href="{{ url('admin/assignments/create') }}"
           class="btn btn-primary btn-sm">
            <i class="fa fa-plus"></i>
            New Assignment
        </a>
    </div>

    <div class="card-body">

        @if (!empty($assignments))

            <div class="row g-3">

                @foreach ($assignments as $assignment)

                    <div class="col-md-6">

                        <div class="card border h-100">

                            <div class="card-body">

                                <div class="d-flex justify-content-between mb-2">

                                    <h5 class="card-title mb-0">
                                        {{ $assignment['title'] }}
                                    </h5>

                                    <span class="badge bg-secondary">
                                        {{ $assignment['status'] }}
                                    </span>

                                </div>

                                <p class="text-muted mb-2">
                                    {{ $assignment['description'] }}
                                </p>

                                <div class="small">

                                    <div class="mb-1">
                                        <strong>Technology:</strong>
                                        {{ $assignment['technology'] }}
                                    </div>

                                    <div class="mb-1">
                                        <strong>Priority:</strong>
                                        {{ $assignment['priority'] }}
                                    </div>

                                    <div class="mb-1">
                                        <strong>Due Date:</strong>
                                        {{ $assignment['due_date'] }}
                                    </div>

                                    <div>
                                        <strong>Created:</strong>
                                        {{ $assignment['created_at'] }}
                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                @endforeach

            </div>

            <div class="text-end mt-3">
                <a href="{{ url('admin/assignments') }}"
                   class="btn btn-outline-primary btn-sm">
                    View All Assignments
                    <i class="fa fa-arrow-right"></i>
                </a>
            </div>

        @else

            <div class="text-center text-muted py-4">
                No assignments found.
            </div>

        @endif

    </div>

</div>