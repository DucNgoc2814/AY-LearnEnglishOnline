/**
 * Rich Text Editor Integration
 * Sử dụng Quill hoặc Summernote thay vì TinyMCE (không yêu cầu API key)
 */
document.addEventListener('DOMContentLoaded', function() {
    // Sử dụng Summernote - một trình soạn thảo văn bản nhẹ, không cần API key
    initializeSummernote();

    function initializeSummernote() {
        // Tạo thẻ link để tải CSS
        var linkCSS = document.createElement('link');
        linkCSS.rel = 'stylesheet';
        linkCSS.href = 'https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-lite.min.css';
        document.head.appendChild(linkCSS);

        // Tạo thẻ script để tải jQuery (cần thiết cho Summernote)
        var jqueryScript = document.createElement('script');
        jqueryScript.src = 'https://code.jquery.com/jquery-3.6.0.min.js';
        document.head.appendChild(jqueryScript);

        jqueryScript.onload = function() {
            // Tạo thẻ script để tải Summernote JS
            var summernoteScript = document.createElement('script');
            summernoteScript.src = 'https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-lite.min.js';
            document.head.appendChild(summernoteScript);

            summernoteScript.onload = function() {
                // Tìm tất cả các textarea có class description-editor
                var textareas = document.querySelectorAll('textarea.description-editor');

                textareas.forEach(function(textarea) {
                    // Lưu ID và name của textarea gốc
                    var originalId = textarea.id;
                    var originalName = textarea.name;
                    var originalValue = textarea.value;

                    // Tạo một container div bao quanh textarea
                    var container = document.createElement('div');
                    container.className = 'summernote-container';
                    textarea.parentNode.insertBefore(container, textarea);

                    // Đưa textarea vào container và ẩn nó đi
                    container.appendChild(textarea);
                    textarea.style.display = 'none';

                    // Tạo div để làm editor
                    var editorDiv = document.createElement('div');
                    editorDiv.className = 'summernote-editor';
                    editorDiv.innerHTML = originalValue;
                    container.appendChild(editorDiv);

                    // Khởi tạo Summernote
                    $(editorDiv).summernote({
                        placeholder: 'Nhập nội dung...',
                        tabsize: 2,
                        height: 200,
                        toolbar: [
                            ['style', ['style']],
                            ['font', ['bold', 'underline', 'italic', 'clear']],
                            ['color', ['color']],
                            ['para', ['ul', 'ol', 'paragraph']],
                            ['table', ['table']],
                            ['insert', ['link', 'picture']],
                            ['view', ['fullscreen', 'codeview', 'help']]
                        ],
                        callbacks: {
                            onChange: function(contents) {
                                // Cập nhật giá trị vào textarea gốc khi nội dung thay đổi
                                textarea.value = contents;
                            }
                        }
                    });
                });

                // Khởi tạo một phiên bản đơn giản hơn cho các textarea có class 'description-simple'
                var simpleTextareas = document.querySelectorAll('textarea.description-simple');

                simpleTextareas.forEach(function(textarea) {
                    // Lưu ID và name của textarea gốc
                    var originalId = textarea.id;
                    var originalName = textarea.name;
                    var originalValue = textarea.value;

                    // Tạo một container div bao quanh textarea
                    var container = document.createElement('div');
                    container.className = 'summernote-container';
                    textarea.parentNode.insertBefore(container, textarea);

                    // Đưa textarea vào container và ẩn nó đi
                    container.appendChild(textarea);
                    textarea.style.display = 'none';

                    // Tạo div để làm editor
                    var editorDiv = document.createElement('div');
                    editorDiv.className = 'summernote-editor-simple';
                    editorDiv.innerHTML = originalValue;
                    container.appendChild(editorDiv);

                    // Khởi tạo Summernote với ít tùy chọn hơn
                    $(editorDiv).summernote({
                        placeholder: 'Nhập nội dung...',
                        tabsize: 2,
                        height: 150,
                        toolbar: [
                            ['font', ['bold', 'underline', 'italic']],
                            ['para', ['ul', 'ol']],
                            ['insert', ['link']]
                        ],
                        callbacks: {
                            onChange: function(contents) {
                                // Cập nhật giá trị vào textarea gốc khi nội dung thay đổi
                                textarea.value = contents;
                            }
                        }
                    });
                });
            };
        };
    }
});
