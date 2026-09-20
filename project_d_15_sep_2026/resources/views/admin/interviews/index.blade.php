@extends('layouts.main')

@section('title', $title ?? 'Interviews')

@section('content')

<div class="container-fluid py-4">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="mb-1">Interviews</h4>
            <p class="text-muted mb-0">
                Manage interviews and their questions.
            </p>
        </div>

        <a href="{{ route('admin.interviews.create') }}"
           class="btn btn-primary">
            <i class="fa fa-plus"></i>
            Create Interview
        </a>
    </div>


    {{-- Success Message --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}

            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert">
            </button>
        </div>
    @endif


    {{-- Error Message --}}
    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}

            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert">
            </button>
        </div>
    @endif


    {{-- Validation Errors --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    {{-- Interview Table --}}
    <div class="card shadow-sm">

        <div class="card-header bg-white">
            <h5 class="mb-0">
                All Interviews
            </h5>
        </div>

        <div class="card-body p-0">

            @if ($interviews->count() > 0)

                <div class="table-responsive">

                    <table class="table table-hover align-middle mb-0">

                        <thead class="table-light">
                            <tr>
                                <th width="60">#</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Duration</th>
                                <th>Status</th>
                                <th>Questions</th>
                                <th>Created</th>
                                <th width="220">Action</th>
                            </tr>
                        </thead>

                        <tbody>

                        @foreach ($interviews as $key => $interview)

                            <tr>
                                <td>
                                    {{ (($page - 1) * $perPage) + $key + 1 }}
                                </td>

                                <td>
                                    <strong>
                                        {{ $interview->title }}
                                    </strong>
                                </td>

                                <td>
                                    @if ($interview->description)
                                        {{ \Illuminate\Support\Str::limit($interview->description, 70) }}
                                    @else
                                        <span class="text-muted">
                                            -
                                        </span>
                                    @endif
                                </td>

                                <td>
                                    @if ($interview->duration)
                                        {{ $interview->duration }} min
                                    @else
                                        -
                                    @endif
                                </td>

                                <td>

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

                                </td>

                                <td>
                                    <span class="badge bg-info text-dark">
                                        {{ $interview->questions_count ?? 0 }}
                                    </span>
                                </td>

                                <td>
                                    {{ $interview->created_at?->format('d M Y') }}
                                </td>

                                <td>

                                    <div class="d-flex gap-1">

                                        {{-- View --}}
                                        <a href="{{ route('admin.interviews.show', $interview->id) }}"
                                           class="btn btn-sm btn-info"
                                           title="View">
                                            <i class="fa fa-eye"></i>
                                        </a>

                                        {{-- Questions --}}
                                        <a href="{{ route('admin.interviews.questions.index', $interview->id) }}"
                                           class="btn btn-sm btn-primary"
                                           title="Questions">
                                            <i class="fa fa-question-circle"></i>
                                        </a>

                                        {{-- Edit --}}
                                        <a href="{{ route('admin.interviews.edit', $interview->id) }}"
                                           class="btn btn-sm btn-warning"
                                           title="Edit">
                                            <i class="fa fa-edit"></i>
                                        </a>

                                        {{-- Delete --}}
                                        <form
                                            action="{{ route('admin.interviews.destroy', $interview->id) }}"
                                            method="POST"
                                            class="d-inline"
                                            onsubmit="return confirm('Are you sure you want to delete this interview?');"
                                        >
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                    class="btn btn-sm btn-danger"
                                                    title="Delete">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </form>

                                    </div>

                                </td>

                            </tr>

                        @endforeach

                        </tbody>

                    </table>

                </div>

            @else

                <div class="text-center py-5">

                    <i class="fa fa-file-text-o fa-3x text-muted mb-3"></i>

                    <h5>
                        No Interviews Found
                    </h5>

                    <p class="text-muted">
                        You have not created any interviews yet.
                    </p>

                    <a href="{{ route('admin.interviews.create') }}"
                       class="btn btn-primary">

                        <i class="fa fa-plus"></i>
                        Create Interview

                    </a>

                </div>

            @endif

        </div>


        <!-- Pagination -->
        @include('admin.users.pagination', ['urlName' => 'admin/interviews'])

    </div>

</div>

@endsection