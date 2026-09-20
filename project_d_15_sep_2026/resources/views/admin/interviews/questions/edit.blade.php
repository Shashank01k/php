@extends('layouts.main')

@section('title', $title ?? 'Edit Question')

@section('content')

<div class="container-fluid py-4">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h4 class="mb-1">Edit Question</h4>

            @if(isset($interview))
                <p class="text-muted mb-0">
                    Interview:
                    <strong>{{ $interview->title }}</strong>
                </p>
            @endif

        </div>

        <a href="{{ route(
            'admin.interviews.questions.index',
            $interview->id
        ) }}"
           class="btn btn-secondary">

            <i class="fa fa-arrow-left"></i>
            Back

        </a>

    </div>


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


    <form action="{{ route(
        'admin.interviews.questions.update',
        [
            'interviewId' => $interview->id,
            'questionId' => $question->id
        ]
    ) }}"
          method="POST"
          enctype="multipart/form-data">

        @csrf

        @method('PUT')


        <div class="card shadow-sm">

            <div class="card-header">
                <strong>Edit Question</strong>
            </div>

            <div class="card-body">

                {{-- Question Type --}}
                <div class="mb-3">

                    <label for="question_type" class="form-label">
                        Question Type <span class="text-danger">*</span>
                    </label>

                    <select name="question_type"
                            id="question_type"
                            class="form-select @error('question_type') is-invalid @enderror"
                            required>

                        <option value="">Select Question Type</option>

                        <option value="mcq"
                            {{ old('question_type', $question->question_type) === 'mcq' ? 'selected' : '' }}>
                            MCQ
                        </option>

                        <option value="paragraph"
                            {{ old('question_type', $question->question_type) === 'paragraph' ? 'selected' : '' }}>
                            Paragraph
                        </option>

                        <option value="media"
                            {{ old('question_type', $question->question_type) === 'media' ? 'selected' : '' }}>
                            Audio / Video / Image
                        </option>

                    </select>

                    @error('question_type')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                {{-- Question --}}
                <div class="mb-3">

                    <label for="question" class="form-label">
                        Question <span class="text-danger">*</span>
                    </label>

                    <textarea name="question"
                              id="question"
                              rows="4"
                              class="form-control @error('question') is-invalid @enderror"
                              required>{{ old('question', $question->question) }}</textarea>

                    @error('question')
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

                    <textarea name="instructions"
                              id="instructions"
                              rows="3"
                              class="form-control"
                              placeholder="Enter instructions for the user...">{{ old('instructions', $question->instructions) }}</textarea>

                </div>


                {{-- Question Specific Section --}}
                <div id="question-section">

                    @include('admin.interviews.questions.sections.mcq', [
                        'question' => $question
                    ])

                    @include('admin.interviews.questions.sections.paragraph', [
                        'question' => $question
                    ])

                    @include('admin.interviews.questions.sections.media', [
                        'question' => $question
                    ])

                </div>


                <div class="row">

                    {{-- Question Order --}}
                    <div class="col-md-3 mb-3">

                        <label for="question_order" class="form-label">
                            Question Order
                        </label>

                        <input type="number"
                               name="question_order"
                               id="question_order"
                               class="form-control"
                               min="0"
                               value="{{ old('question_order', $question->question_order) }}">

                    </div>


                    {{-- Marks --}}
                    <div class="col-md-3 mb-3">

                        <label for="marks" class="form-label">
                            Marks
                        </label>

                        <input type="number"
                               name="marks"
                               id="marks"
                               class="form-control"
                               min="0"
                               step="0.01"
                               value="{{ old('marks', $question->marks) }}">

                    </div>


                    {{-- Required --}}
                    <div class="col-md-3 mb-3">

                        <label class="form-label d-block">
                            Required
                        </label>

                        <div class="form-check form-switch">

                            <input type="checkbox"
                                   name="is_required"
                                   value="1"
                                   class="form-check-input"
                                   id="is_required"
                                   {{ old('is_required', $question->is_required) ? 'checked' : '' }}>

                            <label class="form-check-label"
                                   for="is_required">
                                Required
                            </label>

                        </div>

                    </div>


                    {{-- Active --}}
                    <div class="col-md-3 mb-3">

                        <label class="form-label d-block">
                            Status
                        </label>

                        <div class="form-check form-switch">

                            <input type="checkbox"
                                   name="is_active"
                                   value="1"
                                   class="form-check-input"
                                   id="is_active"
                                   {{ old('is_active', $question->is_active) ? 'checked' : '' }}>

                            <label class="form-check-label"
                                   for="is_active">
                                Active
                            </label>

                        </div>

                    </div>

                </div>

            </div>


            <div class="card-footer">

                <button type="submit" class="btn btn-primary">

                    <i class="fa fa-save"></i>
                    Update Question

                </button>

                <a href="{{ route(
                    'admin.interviews.questions.index',
                    $interview->id
                ) }}"
                   class="btn btn-secondary">

                    Cancel

                </a>

            </div>

        </div>

    </form>

</div>

@endsection


@section('scripts')

<script>

document.addEventListener('DOMContentLoaded', function () {

    const questionType = document.getElementById('question_type');

    const mcqSection = document.getElementById('mcq-section');
    const paragraphSection = document.getElementById('paragraph-section');
    const mediaSection = document.getElementById('media-section');


    function showQuestionSection() {

        mcqSection.style.display = 'none';
        paragraphSection.style.display = 'none';
        mediaSection.style.display = 'none';


        if (questionType.value === 'mcq') {

            mcqSection.style.display = 'block';

        } else if (questionType.value === 'paragraph') {

            paragraphSection.style.display = 'block';

        } else if (questionType.value === 'media') {

            mediaSection.style.display = 'block';

        }

    }


    questionType.addEventListener('change', showQuestionSection);

    showQuestionSection();

});

</script>

@endsection