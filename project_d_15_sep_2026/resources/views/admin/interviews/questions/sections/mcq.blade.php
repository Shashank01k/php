<div id="mcq-section" style="display: none;">

    <div class="card border mb-3">

        <div class="card-header">
            <strong>MCQ Options</strong>
        </div>

        <div class="card-body">

            <div id="mcq-options">

                @php
                    $options = old('options');

                    if (!$options && isset($question) && $question->options) {
                        $options = $question->options->map(function ($option) {
                            return [
                                'option_key' => $option->option_key,
                                'option_text' => $option->option_text,
                                'is_correct' => $option->is_correct,
                            ];
                        })->toArray();
                    }

                    $options = $options ?: [
                        [
                            'option_key' => 'A',
                            'option_text' => '',
                            'is_correct' => 0,
                        ],
                        [
                            'option_key' => 'B',
                            'option_text' => '',
                            'is_correct' => 0,
                        ],
                        [
                            'option_key' => 'C',
                            'option_text' => '',
                            'is_correct' => 0,
                        ],
                        [
                            'option_key' => 'D',
                            'option_text' => '',
                            'is_correct' => 0,
                        ],
                    ];
                @endphp


                @foreach($options as $index => $option)

                    <div class="row mb-3 mcq-option">

                        <div class="col-md-1">

                            <label class="form-label">
                                Option
                            </label>

                            <input type="text"
                                   name="options[{{ $index }}][option_key]"
                                   class="form-control"
                                   value="{{ $option['option_key'] ?? '' }}"
                                   maxlength="10"
                                   readonly>

                        </div>


                        <div class="col-md-8">

                            <label class="form-label">
                                Option Text
                                <span class="text-danger">*</span>
                            </label>

                            <input type="text"
                                   name="options[{{ $index }}][option_text]"
                                   class="form-control"
                                   value="{{ $option['option_text'] ?? '' }}"
                                   placeholder="Enter option">

                        </div>


                        <div class="col-md-2">

                            <label class="form-label d-block">
                                Correct Answer
                            </label>

                            <div class="form-check">

                                <input type="radio"
                                       name="correct_option"
                                       value="{{ $index }}"
                                       class="form-check-input"
                                       {{ !empty($option['is_correct']) ? 'checked' : '' }}>

                                <label class="form-check-label">
                                    Correct
                                </label>

                            </div>

                        </div>


                        <div class="col-md-1 d-flex align-items-end">

                            @if($index >= 4)

                                <button type="button"
                                        class="btn btn-danger remove-option">
                                    <i class="fa fa-trash"></i>
                                </button>

                            @endif

                        </div>

                    </div>

                @endforeach

            </div>


            <button type="button"
                    id="add-option"
                    class="btn btn-outline-primary">

                <i class="fa fa-plus"></i>
                Add Option

            </button>

        </div>

    </div>

</div>


<script>

document.addEventListener('DOMContentLoaded', function () {

    const addOptionButton = document.getElementById('add-option');
    const optionsContainer = document.getElementById('mcq-options');

    if (!addOptionButton || !optionsContainer) {
        return;
    }

    let optionIndex = optionsContainer.querySelectorAll('.mcq-option').length;

    addOptionButton.addEventListener('click', function () {

        const optionNumber = optionIndex;
        const optionKey = String.fromCharCode(65 + optionNumber);

        const html = `
            <div class="row mb-3 mcq-option">

                <div class="col-md-1">

                    <label class="form-label">
                        Option
                    </label>

                    <input type="text"
                           name="options[${optionNumber}][option_key]"
                           class="form-control"
                           value="${optionKey}"
                           maxlength="10"
                           readonly>

                </div>

                <div class="col-md-8">

                    <label class="form-label">
                        Option Text
                        <span class="text-danger">*</span>
                    </label>

                    <input type="text"
                           name="options[${optionNumber}][option_text]"
                           class="form-control"
                           placeholder="Enter option">

                </div>

                <div class="col-md-2">

                    <label class="form-label d-block">
                        Correct Answer
                    </label>

                    <div class="form-check">

                        <input type="radio"
                               name="correct_option"
                               value="${optionNumber}"
                               class="form-check-input">

                        <label class="form-check-label">
                            Correct
                        </label>

                    </div>

                </div>

                <div class="col-md-1 d-flex align-items-end">

                    <button type="button"
                            class="btn btn-danger remove-option">

                        <i class="fa fa-trash"></i>

                    </button>

                </div>

            </div>
        `;

        optionsContainer.insertAdjacentHTML('beforeend', html);

        optionIndex++;

    });


    optionsContainer.addEventListener('click', function (event) {

        const button = event.target.closest('.remove-option');

        if (!button) {
            return;
        }

        button.closest('.mcq-option').remove();

    });

});

</script>