<div id="paragraph-section" style="display: none;">

    <div class="card border mb-3">

        <div class="card-header">
            <strong>Paragraph Answer</strong>
        </div>

        <div class="card-body">

            <div class="mb-3">

                <label for="answer_type" class="form-label">
                    Answer Type
                    <span class="text-danger">*</span>
                </label>

                <select name="answer_type"
                        id="answer_type"
                        class="form-select">

                    <option value="">
                        Select Answer Type
                    </option>

                    <option value="short"
                        {{ old(
                            'answer_type',
                            isset($question) ? $question->answer_type : ''
                        ) === 'short' ? 'selected' : '' }}>
                        Short Answer
                    </option>

                    <option value="long"
                        {{ old(
                            'answer_type',
                            isset($question) ? $question->answer_type : ''
                        ) === 'long' ? 'selected' : '' }}>
                        Long Answer
                    </option>

                </select>

            </div>


            <div class="row">

                <div class="col-md-6 mb-3">

                    <label for="min_length" class="form-label">
                        Minimum Length
                    </label>

                    <input type="number"
                           name="min_length"
                           id="min_length"
                           class="form-control"
                           min="0"
                           value="{{ old(
                               'min_length',
                               isset($question) ? $question->min_length ?? '' : ''
                           ) }}"
                           placeholder="Minimum characters">

                </div>


                <div class="col-md-6 mb-3">

                    <label for="max_length" class="form-label">
                        Maximum Length
                    </label>

                    <input type="number"
                           name="max_length"
                           id="max_length"
                           class="form-control"
                           min="1"
                           value="{{ old(
                               'max_length',
                               isset($question) ? $question->max_length ?? '' : ''
                           ) }}"
                           placeholder="Maximum characters">

                </div>

            </div>

        </div>

    </div>

</div>