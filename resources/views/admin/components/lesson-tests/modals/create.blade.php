<div class="modal fade" id="createLessonTestModal" tabindex="-1" role="dialog" aria-labelledby="createLessonTestModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createLessonTestModalLabel">Thêm bài kiểm tra mới</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('admin.lesson-tests.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label" for="lessonId">Bài học <span class="text-danger">*</span></label>
                        <select class="form-control {{ session('errors') && session('errors')->has('lessonId') ? 'is-invalid' : '' }}"
                            id="lessonId" name="lessonId" required>
                            <option value="">Chọn bài học</option>
                            @foreach (\App\Models\Lesson::all() as $lesson)
                                <option value="{{ $lesson->id }}"
                                    {{ old('lessonId') == $lesson->id ? 'selected' : '' }}>
                                    {{ $lesson->name }}
                                </option>
                            @endforeach
                        </select>
                        @if (session('errors') && session('errors')->has('lessonId'))
                            <div class="invalid-feedback">{{ session('errors')->first('lessonId') }}</div>
                        @endif
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="name">Tên bài kiểm tra <span class="text-danger">*</span></label>
                        <input type="text"
                            class="form-control {{ session('errors') && session('errors')->has('name') ? 'is-invalid' : '' }}"
                            id="name" name="name" value="{{ old('name') }}" required>
                        @if (session('errors') && session('errors')->has('name'))
                            <div class="invalid-feedback">{{ session('errors')->first('name') }}</div>
                        @endif
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="description">Mô tả</label>
                        <textarea class="form-control {{ session('errors') && session('errors')->has('description') ? 'is-invalid' : '' }}"
                            id="description" name="description" rows="3">{{ old('description') }}</textarea>
                        @if (session('errors') && session('errors')->has('description'))
                            <div class="invalid-feedback">{{ session('errors')->first('description') }}</div>
                        @endif
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="duration">Thời gian làm bài (phút) <span class="text-danger">*</span></label>
                            <input type="number"
                                class="form-control {{ session('errors') && session('errors')->has('duration') ? 'is-invalid' : '' }}"
                                id="duration" name="duration" value="{{ old('duration') }}" required>
                            @if (session('errors') && session('errors')->has('duration'))
                                <div class="invalid-feedback">{{ session('errors')->first('duration') }}</div>
                            @endif
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="maxAttempt">Số lần làm tối đa</label>
                            <input type="number"
                                class="form-control {{ session('errors') && session('errors')->has('maxAttempt') ? 'is-invalid' : '' }}"
                                id="maxAttempt" name="maxAttempt" value="{{ old('maxAttempt') }}">
                            @if (session('errors') && session('errors')->has('maxAttempt'))
                                <div class="invalid-feedback">{{ session('errors')->first('maxAttempt') }}</div>
                            @endif
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="minScore">Điểm tối thiểu <span class="text-danger">*</span></label>
                            <input type="number"
                                step="0.01"
                                min="0"
                                max="100"
                                class="form-control {{ session('errors') && session('errors')->has('minScore') ? 'is-invalid' : '' }}"
                                id="minScore" name="minScore" value="{{ old('minScore') }}" required>
                            @if (session('errors') && session('errors')->has('minScore'))
                                <div class="invalid-feedback">{{ session('errors')->first('minScore') }}</div>
                            @endif
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="maxScore">Điểm tối đa <span class="text-danger">*</span></label>
                            <input type="number"
                                step="0.01"
                                min="0"
                                max="100"
                                class="form-control {{ session('errors') && session('errors')->has('maxScore') ? 'is-invalid' : '' }}"
                                id="maxScore" name="maxScore" value="{{ old('maxScore') }}" required>
                            @if (session('errors') && session('errors')->has('maxScore'))
                                <div class="invalid-feedback">{{ session('errors')->first('maxScore') }}</div>
                            @endif
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="isRequired" name="isRequired"
                                value="1" {{ old('isRequired') ? 'checked' : '' }}>
                            <label class="form-check-label" for="isRequired">
                                Bắt buộc phải hoàn thành
                            </label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                    <button type="submit" class="btn btn-primary">Thêm mới</button>
                </div>
            </form>
        </div>
    </div>
</div>
