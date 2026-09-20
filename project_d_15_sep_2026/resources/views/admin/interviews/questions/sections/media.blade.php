<div id="media-section" style="display: none;">

    <div class="card border mb-3">

        <div class="card-header">
            <strong>Media Question</strong>
        </div>

        <div class="card-body">

            <div class="mb-3">

                <label for="media_type" class="form-label">
                    Media Type
                    <span class="text-danger">*</span>
                </label>

                <select name="media_type"
                        id="media_type"
                        class="form-select">

                    <option value="">
                        Select Media Type
                    </option>

                    <option value="audio"
                        {{ old(
                            'media_type',
                            isset($question) ? $question->media_type : ''
                        ) === 'audio' ? 'selected' : '' }}>
                        Audio
                    </option>

                    <option value="video"
                        {{ old(
                            'media_type',
                            isset($question) ? $question->media_type : ''
                        ) === 'video' ? 'selected' : '' }}>
                        Video
                    </option>

                    <option value="image"
                        {{ old(
                            'media_type',
                            isset($question) ? $question->media_type : ''
                        ) === 'image' ? 'selected' : '' }}>
                        Image
                    </option>

                </select>

            </div>


            <div class="mb-3">

                <label for="max_file_size" class="form-label">
                    Maximum File Size (KB)
                </label>

                <input type="number"
                       name="max_file_size"
                       id="max_file_size"
                       class="form-control"
                       min="1"
                       value="{{ old(
                           'max_file_size',
                           isset($question) ? $question->max_file_size ?? '' : ''
                       ) }}"
                       placeholder="Example: 10240">

                <small class="text-muted">
                    Enter maximum allowed file size in KB.
                </small>

            </div>


            @if(isset($question) && $question->media_type)

                <div class="alert alert-info">

                    <strong>Current Media Type:</strong>
                    {{ ucfirst($question->media_type) }}

                </div>

            @endif

        </div>

    </div>

</div>