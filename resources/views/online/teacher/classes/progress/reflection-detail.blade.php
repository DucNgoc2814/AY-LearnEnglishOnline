@extends('online.layouts.master')

@section('title', 'Chi tiết Reflection')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Chi tiết bài Reflection</h1>

    <!-- Student Info -->
    <div class="card mb-4">
        <div class="card-body">
            <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                    <img src="{{ $student->avatar_url ?? '' }}" alt="Student Avatar" class="rounded-circle me-3" width="60" height="60">
                    <div>
                        <h4 class="mb-1">{{ $student->name }}</h4>
                        <p class="text-muted mb-0">ID: {{ $student->id }}</p>
                    </div>
                </div>
                <div>
                    <button type="button" class="btn btn-primary" id="saveChanges">
                        <i class="fas fa-save me-2"></i>Lưu thay đổi
                    </button>
                </div>
            </div>
        </div>
    </div>

    <form id="reflectionForm">
        <!-- Sentence Structures -->
        <div class="card mb-4">
            <div class="card-header bg-light">
                <h5 class="mb-0">Useful Sentence Structures</h5>
            </div>
            <div class="card-body">
                <!-- Structure 1 -->
                <div class="mb-4">
                    <div class="d-flex align-items-center mb-2">
                        <span class="me-2">1.</span>
                        <div>
                            <div class="text-primary mb-1">X is a nice place, but sometimes ...</div>
                            <div class="text-muted small">(X là một nơi dễ chịu, nhưng thỉnh thoảng...)</div>
                            <div class="text-muted small fst-italic">E.g: Banbury's nice, but sometimes I find it a bit boring</div>
                        </div>
                    </div>
                    <div class="form-group editor-container">
                        <textarea class="editor" name="answer1" id="answer1">Hanoi is a nice place, but sometimes it's too crowded and noisy.</textarea>
                    </div>
                </div>

                <!-- Structure 2 -->
                <div class="mb-4">
                    <div class="d-flex align-items-center mb-2">
                        <span class="me-2">2.</span>
                        <div>
                            <div class="text-primary mb-1">I find it + (tính từ)</div>
                            <div class="text-muted small">(Mình thấy (điều này) + tính từ)</div>
                            <div class="text-muted small fst-italic">E.g: I find it a bit boring.</div>
                        </div>
                    </div>
                    <div class="form-group editor-container">
                        <textarea class="editor" name="answer2" id="answer2">I find it very exciting to explore the old quarter of Hanoi.</textarea>
                    </div>
                </div>

                <!-- Structure 3 -->
                <div class="mb-4">
                    <div class="d-flex align-items-center mb-2">
                        <span class="me-2">3.</span>
                        <div>
                            <div class="text-primary mb-1">I am not very keen on + V-ing/cụm danh từ</div>
                            <div class="text-muted small">(Mình không thích lắm việc...)</div>
                            <div class="text-muted small fst-italic">E.g: I am not very keen on shopping.</div>
                        </div>
                    </div>
                    <div class="form-group editor-container">
                        <textarea class="editor" name="answer3" id="answer3">I am not very keen on going out during rush hours in Hanoi.</textarea>
                    </div>
                </div>
            </div>
        </div>

        <!-- Reflection Questions -->
        <div class="card mb-4">
            <div class="card-header bg-light">
                <h5 class="mb-0">Write Your Reflection</h5>
            </div>
            <div class="card-body">
                <!-- Question 1 -->
                <div class="mb-4">
                    <h6 class="mb-3">1. Where is your hometown?</h6>
                    <div class="form-group editor-container">
                        <textarea class="editor" name="reflection1" id="reflection1">My hometown is Hanoi, the capital city of Vietnam. It's a city with over a thousand years of history and culture.</textarea>
                    </div>
                </div>

                <!-- Question 2 -->
                <div class="mb-4">
                    <h6 class="mb-3">2. What do you like most about living there?</h6>
                    <div class="form-group editor-container">
                        <textarea class="editor" name="reflection2" id="reflection2">I find it fascinating to live in Hanoi because of its rich cultural heritage, delicious street food, and the perfect blend of traditional and modern lifestyles.</textarea>
                    </div>
                </div>

                <!-- Question 3 -->
                <div class="mb-4">
                    <h6 class="mb-3">3. Is there anything you don't like about your hometown?</h6>
                    <div class="form-group editor-container">
                        <textarea class="editor" name="reflection3" id="reflection3">I am not very keen on the traffic congestion and air pollution, especially during peak hours. Sometimes the weather can be quite extreme too.</textarea>
                    </div>
                </div>

                <!-- Question 4 -->
                <div class="mb-4">
                    <h6 class="mb-3">4. What kinds of things can visitors to your hometown do and see?</h6>
                    <div class="form-group editor-container">
                        <textarea class="editor" name="reflection4" id="reflection4">Visitors can explore many historical sites like the Temple of Literature, Hoan Kiem Lake, and the Old Quarter. They can also enjoy traditional Vietnamese cuisine and experience the unique local culture.</textarea>
                    </div>
                </div>

                <!-- Question 5 -->
                <div class="mb-4">
                    <h6 class="mb-3">5. How is your hometown changing?</h6>
                    <div class="form-group editor-container">
                        <textarea class="editor" name="reflection5" id="reflection5">Hanoi is rapidly modernizing with new buildings, shopping centers, and improved infrastructure. However, it still maintains its traditional charm and historical architecture.</textarea>
                    </div>
                </div>
            </div>
        </div>

        <!-- Teacher's Feedback -->
        <div class="card mb-4">
            <div class="card-header bg-light">
                <h5 class="mb-0">Nhận xét của giáo viên</h5>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label class="form-label">Chi tiết nhận xét</label>
                    <textarea class="editor" name="teacherFeedback" id="teacherFeedback">Bài viết rất tốt, thể hiện khả năng sử dụng từ vựng và cấu trúc câu đa dạng. Em đã:
- Sử dụng đúng và hiệu quả các cấu trúc câu đã học
- Trình bày ý tưởng mạch lạc, rõ ràng
- Có sự kết hợp tốt giữa các ý trong bài

Cần cải thiện: Một số lỗi ngữ pháp nhỏ trong cách sử dụng thì.</textarea>
                </div>
            </div>
        </div>
    </form>
</div>

@push('styles')
<style>
.editor-container {
    position: relative;
    margin-bottom: 2rem;
}
.tox-tinymce {
    border: 1px solid #ced4da !important;
    border-radius: 0.25rem !important;
    min-height: 300px !important;
}
.tox .tox-edit-area__iframe {
    background-color: #fff !important;
    min-height: 300px !important;
}
.tox .tox-comment {
    background-color: #fff3cd;
    border: 1px solid #ffeeba;
    border-radius: 3px;
    padding: 8px;
    margin: 4px 0;
}
.tox .tox-comment-author {
    font-weight: bold;
    color: #856404;
}
.tox .tox-comment-date {
    color: #666;
    font-size: 0.9em;
}
.tox .tox-selected-comment {
    background-color: #ffeeba !important;
}
.tox .tox-comment-thread {
    border-left: 2px solid #ffc107;
}
</style>
@endpush

@push('scripts')
<script src="{{ asset('assets/libs/tinymce/tinymce.min.js') }}"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    let editors = [];
    const currentUser = {
        id: '{{ auth()->id() }}',
        name: '{{ auth()->user()->name }}'
    };

    // Initialize TinyMCE
    function initEditor(selector) {
        return tinymce.init({
            selector: selector,
            height: 300,
            min_height: 300,
            menubar: true,
            plugins: [
                'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview',
                'anchor', 'searchreplace', 'visualblocks', 'code', 'fullscreen',
                'insertdatetime', 'media', 'table', 'help', 'wordcount',
                'quickbars', 'emoticons', 'codesample', 'directionality', 'visualchars',
                'nonbreaking', 'save', 'pagebreak', 'comments'
            ],
            toolbar: [
                'undo redo | styles | bold italic | alignleft aligncenter alignright alignjustify',
                'bullist numlist outdent indent | addcomment showcomments'
            ],
            quickbars_selection_toolbar: 'bold italic | addcomment',
            contextmenu: 'addcomment showcomments',
            comments_ui_hover_delay: 0,
            sidebar: 'comments',
            toolbar_sticky: true,
            toolbar_mode: 'sliding',
            content_css: [
                '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
                '//www.tiny.cloud/css/codepen.min.css'
            ],
            content_style: `
                body { font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif; font-size: 14px; }
                .mce-annotation { background-color: #fff3cd; }
                .mce-annotation.mce-annotation-selected { background-color: #ffeeba; }
                .tox-comments-visible span[data-mce-comment] { background-color: #fff3cd; }
            `,
            comments_resolver: (data, resolve) => {
                resolve({
                    ...data,
                    author: currentUser.name,
                    authorId: currentUser.id,
                    created: new Date().toISOString()
                });
            },
            setup: function(editor) {
                editors.push(editor);

                // Add keyboard shortcut for commenting
                editor.addShortcut('ctrl+alt+c', 'Add comment', function() {
                    editor.execCommand('mceComment');
                });

                // Add custom comment handling
                editor.on('init', function() {
                    editor.annotator.register('comment', {
                        persistent: true,
                        decorate: function(uid, data) {
                            return {
                                attributes: {
                                    'data-mce-comment': uid,
                                    'data-mce-comment-author': data.author,
                                    'data-mce-comment-datetime': data.created
                                },
                                classes: ['mce-annotation']
                            };
                        }
                    });
                });

                // Log when comment is added
                editor.on('CommentAdd', function(e) {
                    console.log('Comment added:', e);
                });
            }
        });
    }

    // Initialize all editors
    initEditor('.editor').then(function() {
        console.log('All editors initialized');
    });

    // Save changes
    document.getElementById('saveChanges').addEventListener('click', function() {
        const formData = new FormData();

        // Collect data from all editors
        editors.forEach(function(editor) {
            // Get content with comments
            const content = editor.getContent();
            formData.append(editor.id, content);

            // Get comments separately
            const comments = editor.annotator.getAll('comment');
            formData.append(editor.id + '_comments', JSON.stringify(comments));
        });

        // Add evaluation
        formData.append('evaluation', document.getElementById('evaluation').value);

        // Send data to server
        fetch('{{ route("online.teacher.classes.progress.reflection.save", ["id" => $class->id, "student_id" => $student->id]) }}', {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        })
        .then(response => response.json())
        .then(data => {
            alert('Đã lưu thay đổi thành công!');
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Có lỗi xảy ra khi lưu thay đổi!');
        });
    });
});
</script>
@endpush
@endsection
