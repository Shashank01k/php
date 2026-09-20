@extends('layouts.main')

@section('title', $title ?? 'Create Interview')

@section('content')

<div class="container-fluid py-4">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h4 class="mb-1">
                Create Interview
            </h4>

            <p class="text-muted mb-0">
                Create a new interview for users.
            </p>
        </div>

        <a href="{{ route('admin.interviews.index') }}"
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

                    <li>
                        {{ $error }}
                    </li>

                @endforeach

            </ul>

        </div>

    @endif


    {{-- Create Form --}}
    <div class="card shadow-sm">

        <div class="card-header bg-white">

            <h5 class="mb-0">
                Interview Details
            </h5>

        </div>


        <div class="card-body">

            <form
                action="{{ route('admin.interviews.store') }}"
                method="POST"
            >

                @csrf


                {{-- Title --}}
                <div class="mb-3">

                    <label for="title" class="form-label">
                        Interview Title
                        <span class="text-danger">*</span>
                    </label>

                    <input
                        type="text"
                        name="title"
                        id="title"
                        class="form-control @error('title') is-invalid @enderror"
                        value="{{ old('title') }}"
                        placeholder="Enter interview title"
                        maxlength="255"
                        required
                    >

                    @error('title')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                {{-- Description --}}
                <div class="mb-3">

                    <label for="description" class="form-label">
                        Description
                    </label>

                    <textarea
                        name="description"
                        id="description"
                        rows="4"
                        class="form-control @error('description') is-invalid @enderror"
                        placeholder="Enter interview description"
                    >{{ old('description') }}</textarea>

                    @error('description')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                {{-- Instructions --}}
                <div class="mb-3">

                    <label for="instructions" class="form-label">
                        Instructions
                    </label>

                    <textarea
                        name="instructions"
                        id="instructions"
                        rows="5"
                        class="form-control @error('instructions') is-invalid @enderror"
                        placeholder="Enter instructions for the user"
                    >{{ old('instructions') }}</textarea>

                    @error('instructions')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                <div class="row">

                    {{-- Duration --}}
                    <div class="col-md-4 mb-3">

                        <label for="duration" class="form-label">
                            Duration
                        </label>

                        <div class="input-group">

                            <input
                                type="number"
                                name="duration"
                                id="duration"
                                class="form-control @error('duration') is-invalid @enderror"
                                value="{{ old('duration') }}"
                                min="1"
                                placeholder="60"
                            >

                            <span class="input-group-text">
                                Minutes
                            </span>

                        </div>

                        @error('duration')
                            <div class="text-danger small mt-1">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    {{-- Status --}}
                    <div class="col-md-4 mb-3">

                        <label for="status" class="form-label">
                            Status
                            <span class="text-danger">*</span>
                        </label>

                        <select
                            name="status"
                            id="status"
                            class="form-select @error('status') is-invalid @enderror"
                            required
                        >

                            <option value="draft"
                                {{ old('status', 'draft') === 'draft' ? 'selected' : '' }}>
                                Draft
                            </option>

                            <option value="published"
                                {{ old('status') === 'published' ? 'selected' : '' }}>
                                Published
                            </option>

                            <option value="closed"
                                {{ old('status') === 'closed' ? 'selected' : '' }}>
                                Closed
                            </option>

                        </select>

                        @error('status')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    {{-- Active --}}
                    <div class="col-md-4 mb-3">

                        <label class="form-label">
                            Active
                        </label>

                        <div class="form-check mt-2">

                            <input
                                type="checkbox"
                                name="is_active"
                                value="1"
                                id="is_active"
                                class="form-check-input"
                                {{ old('is_active', 1) ? 'checked' : '' }}
                            >

                            <label
                                class="form-check-label"
                                for="is_active"
                            >
                                Active Interview
                            </label>

                        </div>

                    </div>

                </div>


                {{-- Buttons --}}
                <div class="border-top pt-3 mt-3">

                    <button
                        type="submit"
                        class="btn btn-primary"
                    >

                        <i class="fa fa-save"></i>
                        Save Interview

                    </button>

                    <a
                        href="{{ route('admin.interviews.index') }}"
                        class="btn btn-secondary"
                    >

                        Cancel

                    </a>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection