@extends('layouts.main')

@section('title', 'Edit Assignment')

@section('content')

<div class="container-fluid py-4">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h4 class="mb-0">
            Edit Assignment
        </h4>

        <a href="{{ route('admin.assignments.index') }}"
           class="btn btn-secondary">
            <i class="fa fa-arrow-left"></i>
            Back
        </a>

    </div>


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


    <div class="card shadow-sm">

        <div class="card-header">
            <strong>
                Edit Assignment
            </strong>
        </div>

        <div class="card-body">

            <form
                method="POST"
                action="{{ route('admin.assignments.update', $assignment->id) }}"
            >

                @csrf
                @method('PUT')


                <div class="row">

                    {{-- Title --}}
                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Title <span class="text-danger">*</span>
                        </label>

                        <input
                            type="text"
                            name="title"
                            class="form-control"
                            value="{{ old('title', $assignment->title) }}"
                            placeholder="Enter assignment title"
                        >

                    </div>


                    {{-- Technology --}}
                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Technology
                        </label>

                        <input
                            type="text"
                            name="technology"
                            class="form-control"
                            value="{{ old('technology', $assignment->technology) }}"
                            placeholder="e.g. PHP, Laravel, MySQL"
                        >

                    </div>


                    {{-- Assigned To --}}
                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Assign To <span class="text-danger">*</span>
                        </label>

                        <select
                            name="assigned_to"
                            class="form-select"
                        >

                            <option value="">
                                Select User
                            </option>

                            @foreach ($users as $user)

                                <option
                                    value="{{ $user->id }}"
                                    {{ old('assigned_to', $assignment->assigned_to) == $user->id ? 'selected' : '' }}
                                >
                                    {{ $user->user_name }}
                                </option>

                            @endforeach

                        </select>

                    </div>


                    {{-- Status --}}
                    <div class="col-md-3 mb-3">

                        <label class="form-label">
                            Status
                        </label>

                        <select
                            name="status"
                            class="form-select"
                        >

                            @php
                                $statuses = [
                                    'pending' => 'Pending',
                                    'in_progress' => 'In Progress',
                                    'completed' => 'Completed',
                                    'cancelled' => 'Cancelled',
                                ];
                            @endphp

                            @foreach ($statuses as $value => $label)

                                <option
                                    value="{{ $value }}"
                                    {{ old('status', $assignment->status) === $value ? 'selected' : '' }}
                                >
                                    {{ $label }}
                                </option>

                            @endforeach

                        </select>

                    </div>


                    {{-- Priority --}}
                    <div class="col-md-3 mb-3">

                        <label class="form-label">
                            Priority
                        </label>

                        <select
                            name="priority"
                            class="form-select"
                        >

                            @php
                                $priorities = [
                                    'low' => 'Low',
                                    'medium' => 'Medium',
                                    'high' => 'High',
                                ];
                            @endphp

                            @foreach ($priorities as $value => $label)

                                <option
                                    value="{{ $value }}"
                                    {{ old('priority', $assignment->priority) === $value ? 'selected' : '' }}
                                >
                                    {{ $label }}
                                </option>

                            @endforeach

                        </select>

                    </div>


                    {{-- Due Date --}}
                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Due Date
                        </label>

                        <input
                            type="date"
                            name="due_date"
                            class="form-control"
                            value="{{ old('due_date', $assignment->due_date) }}"
                        >

                    </div>


                    {{-- Description --}}
                    <div class="col-12 mb-3">

                        <label class="form-label">
                            Description
                        </label>

                        <textarea
                            name="description"
                            rows="5"
                            class="form-control"
                            placeholder="Enter assignment description"
                        >{{ old('description', $assignment->description) }}</textarea>

                    </div>

                </div>


                <div class="d-flex justify-content-end gap-2">

                    <a
                        href="{{ route('admin.assignments.index') }}"
                        class="btn btn-secondary"
                    >
                        Cancel
                    </a>

                    <button
                        type="submit"
                        class="btn btn-primary"
                    >
                        <i class="fa fa-save"></i>
                        Update Assignment
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection