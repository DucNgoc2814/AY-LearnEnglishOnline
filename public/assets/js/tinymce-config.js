document.addEventListener('DOMContentLoaded', function() {
    // Tìm textarea có id chính xác là "description"
    const descriptionElements = document.querySelectorAll('textarea[id="description"]');

    if (descriptionElements.length > 0) {
        descriptionElements.forEach(element => {
            tinymce.init({
                selector: '#description',  // Chỉ select chính xác id="description"
                plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
                toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
                font_family_formats: 'Arial=arial,helvetica,sans-serif; Courier New=courier new,courier,monospace; AkrutiKndPadmini=Akpdmi-n',
                font_size_formats: '8pt 10pt 12pt 14pt 16pt 18pt 24pt 36pt 48pt',
                height: 300,
                language: 'vi',
                // Các tùy chọn khác
                image_title: true,
                automatic_uploads: true,
                file_picker_types: 'image',
                file_picker_callback: function (cb, value, meta) {
                    var input = document.createElement('input');
                    input.setAttribute('type', 'file');
                    input.setAttribute('accept', 'image/*');

                    input.onchange = function () {
                        var file = this.files[0];

                        var reader = new FileReader();
                        reader.onload = function () {
                            var id = 'blobid' + (new Date()).getTime();
                            var blobCache =  tinymce.activeEditor.editorUpload.blobCache;
                            var base64 = reader.result.split(',')[1];
                            var blobInfo = blobCache.create(id, file, base64);
                            blobCache.add(blobInfo);

                            cb(blobInfo.blobUri(), { title: file.name });
                        };
                        reader.readAsDataURL(file);
                    };

                    input.click();
                }
            });
        });
    }
});