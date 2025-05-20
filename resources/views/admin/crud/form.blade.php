@extends('admin.layouts.app')

@section('title', isset($item) ? 'Edit' : 'Create New')

@section('content')
<div class="bg-white shadow rounded-lg">
    <div class="p-6">
        <h2 class="text-xl font-semibold text-gray-900 mb-6">
            {{ isset($item) ? 'Edit' : 'Create New' }}
        </h2>

        <form action="{{ isset($item) ? route($route.'.update', $item->id) : route($route.'.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @if(isset($item))
                @method('PUT')
            @endif

            <!-- Main Model Fields -->
            <div class="mb-8">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Thông tin chính</h3>
                <div class="bg-gray-50 p-4 rounded-lg">
                    @foreach($fields as $field => $options)
                        <div class="mb-4 field-wrapper"
                             data-field="{{ $field }}"
                             @if(isset($options['depends_on']))
                             data-depends-on="{{ $options['depends_on']['field'] }}"
                             data-depends-values="{{ json_encode($options['depends_on']['values']) }}"
                             data-show-if-in="{{ $options['depends_on']['show_if_in'] ? 'true' : 'false' }}"
                             style="display: none;"
                             @endif
                        >
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="{{ $field }}">
                                {{ $options['label'] ?? ucfirst($field) }}
                            </label>

                            @switch($options['type'] ?? 'text')
                                @case('textarea')
                                    <textarea
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline {{ $field == 'description' ? 'description-editor' : '' }}"
                                        id="{{ $field }}"
                                        name="{{ $field }}"
                                        rows="4"
                                    >{{ old($field, isset($item) ? $item->$field : '') }}</textarea>
                                    @break

                                @case('select')
                                    <select
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                        id="{{ $field }}"
                                        name="{{ $field }}"
                                    >
                                        @foreach($options['options'] ?? [] as $value => $label)
                                            <option value="{{ $value }}" {{ old($field, isset($item) ? $item->$field : '') == $value ? 'selected' : '' }}>
                                                {{ $label }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @break

                                @case('file')
                                    <div class="media-upload-container">
                                        <input
                                            type="file"
                                            class="hidden media-input"
                                            id="{{ $field }}"
                                            name="{{ $field }}"
                                            accept="{{ implode(',', array_map(fn($mime) => '.' . $mime, explode(',', $options['mimes'] ?? ''))) }}"
                                            onchange="handleMediaPreview(this)"
                                        >

                                        <label for="{{ $field }}" class="cursor-pointer block">
                                            <div class="media-preview-container border-2 border-dashed border-gray-300 rounded-lg p-4 text-center hover:border-blue-500 transition-colors">
                                                <!-- Preview Container -->
                                                <div class="preview-box {{ isset($item) && $item->$field ? '' : 'hidden' }} mb-3">
                                                    @php
                                                        $mediaUrl = isset($item) ? $item->getMediaUrl($field) : null;
                                                        $extension = isset($item) && $item->$field ? pathinfo($item->$field, PATHINFO_EXTENSION) : '';
                                                        $fileType = '';

                                                        if (in_array(strtolower($extension), ['jpg', 'jpeg', 'png', 'gif'])) {
                                                            $fileType = 'image';
                                                        } elseif (in_array(strtolower($extension), ['mp4', 'mov', 'avi'])) {
                                                            $fileType = 'video';
                                                        } elseif (in_array(strtolower($extension), ['mp3', 'wav'])) {
                                                            $fileType = 'audio';
                                                        }
                                                    @endphp

                                                    @if($fileType == 'image')
                                                        <img src="{{ $mediaUrl }}" class="max-h-48 mx-auto rounded-lg shadow-sm" alt="Preview">
                                                    @elseif($fileType == 'video')
                                                        <video src="{{ $mediaUrl }}" class="max-h-48 mx-auto rounded-lg shadow-sm" controls></video>
                                                    @elseif($fileType == 'audio')
                                                        <audio src="{{ $mediaUrl }}" class="w-full" controls></audio>
                                                    @endif
                                                </div>

                                                <!-- Upload Icon & Text -->
                                                <div class="upload-placeholder {{ isset($item) && $item->$field ? 'hidden' : '' }}">
                                                    <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                                        <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4-4m0 0l4-4m-4 4l-4 4m8-12V12a4 4 0 00-4-4h-12" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                    </svg>
                                                    <p class="mt-1 text-sm text-gray-600">
                                                        Click to upload or drag and drop<br>
                                                        {{ implode(', ', explode(',', strtoupper($options['mimes'] ?? ''))) }}
                                                    </p>
                                                </div>

                                                <!-- File Info -->
                                                <div class="file-info {{ isset($item) && $item->$field ? '' : 'hidden' }} mt-2 text-sm text-gray-600">
                                                    <p class="selected-file-name">
                                                        {{ isset($item) && $item->$field ? basename($item->$field) : '' }}
                                                    </p>
                                                    <button type="button"
                                                            class="text-red-600 hover:text-red-800 mt-1"
                                                            onclick="removeMedia(this, '{{ $field }}')">
                                                        Remove
                                                    </button>
                                                </div>
                                            </div>
                                        </label>
                                    </div>

                                    @error($field)
                                        <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                                    @enderror
                                    @break

                                @case('checkbox')
                                    <div class="flex items-center">
                                        <input
                                            type="checkbox"
                                            class="form-checkbox h-5 w-5 text-blue-600"
                                            id="{{ $field }}"
                                            name="{{ $field }}"
                                            value="1"
                                            {{ old($field, isset($item) && $item->$field ? 'checked' : '') }}
                                        >
                                        <span class="ml-2 text-gray-700">{{ $options['label'] ?? ucfirst($field) }}</span>
                                    </div>
                                    @break

                                @default
                                    <input
                                        type="{{ $options['type'] ?? 'text' }}"
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                        id="{{ $field }}"
                                        name="{{ $field }}"
                                        value="{{ old($field, isset($item) ? $item->$field : '') }}"
                                        @if(isset($options['step'])) step="{{ $options['step'] }}" @endif
                                    >
                            @endswitch

                            @error($field)
                                <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Related Models -->
            @if(isset($related_fields))
                @foreach($related_fields as $relation => $relationFields)
                    <div class="mb-8 related-model-section" data-relation="{{ $relation }}">
                        <h3 class="text-lg font-medium text-gray-900 mb-4 flex items-center">
                            {{ ucfirst(str_replace('_', ' ', $relation)) }}
                            @if(isset($relations[$relation]['multiple']) && $relations[$relation]['multiple'])
                                <button type="button"
                                        class="ml-2 inline-flex items-center bg-green-500 hover:bg-green-600 text-xs text-white font-bold py-1 px-2 rounded focus:outline-none focus:ring-2 focus:ring-green-300 add-related-btn"
                                        data-relation="{{ $relation }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 mr-1">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                    </svg>
                                    Thêm mới
                                </button>
                            @endif
                        </h3>

                        @if(isset($relations[$relation]['multiple']) && $relations[$relation]['multiple'])
                            <!-- Multiple Related Items (1-n) -->
                            <div class="related-items-container" id="container-{{ $relation }}">
                                @if(isset($related_items[$relation]) && $related_items[$relation]->count() > 0)
                                    @foreach($related_items[$relation] as $index => $relatedItem)
                                        <div class="mb-4 bg-gray-50 p-4 rounded-lg related-item">
                                            <div class="flex justify-between items-center mb-2">
                                                <h4 class="font-medium">Item #{{ $index + 1 }}</h4>
                                                <button type="button" class="text-red-500 hover:text-red-700 hover:bg-red-50 p-1 rounded-full transition-colors remove-related-btn">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                                    </svg>
                                                </button>
                                            </div>
                                            @foreach($relationFields as $rField => $rOptions)
                                                <div class="mb-2">
                                                    <label class="block text-gray-700 text-sm font-bold mb-1">
                                                        {{ $rOptions['label'] ?? ucfirst($rField) }}
                                                    </label>

                                                    @switch($rOptions['type'] ?? 'text')
                                                        @case('textarea')
                                                            <textarea
                                                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline {{ $rField == 'description' || $rField == 'additional_info' ? 'description-editor' : '' }}"
                                                                name="related_{{ $relation }}[{{ $index }}][{{ $rField }}]"
                                                                id="related_{{ $relation }}_{{ $index }}_{{ $rField }}"
                                                                rows="3"
                                                            >{{ old("related_{$relation}.{$index}.{$rField}", $relatedItem->$rField) }}</textarea>
                                                            @break

                                                        @case('select')
                                                            <select
                                                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                                                name="related_{{ $relation }}[{{ $index }}][{{ $rField }}]"
                                                            >
                                                                @foreach($rOptions['options'] ?? [] as $value => $label)
                                                                    <option value="{{ $value }}" {{ old("related_{$relation}.{$index}.{$rField}", $relatedItem->$rField) == $value ? 'selected' : '' }}>
                                                                        {{ $label }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                            @break

                                                        @default
                                                            <input
                                                                type="{{ $rOptions['type'] ?? 'text' }}"
                                                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                                                name="related_{{ $relation }}[{{ $index }}][{{ $rField }}]"
                                                                value="{{ old("related_{$relation}.{$index}.{$rField}", $relatedItem->$rField) }}"
                                                            >
                                                    @endswitch
                                                </div>
                                            @endforeach
                                        </div>
                                    @endforeach
                                @else
                                    <div class="mb-4 bg-gray-50 p-4 rounded-lg related-item">
                                        <div class="flex justify-between items-center mb-2">
                                            <h4 class="font-medium">Item #1</h4>
                                            <button type="button" class="text-red-500 hover:text-red-700 hover:bg-red-50 p-1 rounded-full transition-colors remove-related-btn">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                                </svg>
                                            </button>
                                        </div>
                                        @foreach($relationFields as $rField => $rOptions)
                                            <div class="mb-2">
                                                <label class="block text-gray-700 text-sm font-bold mb-1">
                                                    {{ $rOptions['label'] ?? ucfirst($rField) }}
                                                </label>

                                                @switch($rOptions['type'] ?? 'text')
                                                    @case('textarea')
                                                        <textarea
                                                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline {{ $rField == 'description' || $rField == 'additional_info' ? 'description-editor' : '' }}"
                                                            name="related_{{ $relation }}[0][{{ $rField }}]"
                                                            id="related_{{ $relation }}_0_{{ $rField }}"
                                                            rows="3"
                                                        >{{ old("related_{$relation}.0.{$rField}") }}</textarea>
                                                        @break

                                                    @case('select')
                                                        <select
                                                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                                            name="related_{{ $relation }}[0][{{ $rField }}]"
                                                        >
                                                            @foreach($rOptions['options'] ?? [] as $value => $label)
                                                                <option value="{{ $value }}" {{ old("related_{$relation}.0.{$rField}") == $value ? 'selected' : '' }}>
                                                                    {{ $label }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        @break

                                                    @default
                                                        <input
                                                            type="{{ $rOptions['type'] ?? 'text' }}"
                                                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                                            name="related_{{ $relation }}[0][{{ $rField }}]"
                                                            value="{{ old("related_{$relation}.0.{$rField}") }}"
                                                        >
                                                @endswitch
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                            </div>

                            <div class="hidden" id="template-{{ $relation }}">
                                <div class="mb-4 bg-gray-50 p-4 rounded-lg related-item">
                                    <div class="flex justify-between items-center mb-2">
                                        <h4 class="font-medium">New Item</h4>
                                        <button type="button" class="text-red-500 hover:text-red-700 hover:bg-red-50 p-1 rounded-full transition-colors remove-related-btn">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                        </button>
                                    </div>
                                    @foreach($relationFields as $rField => $rOptions)
                                        <div class="mb-2">
                                            <label class="block text-gray-700 text-sm font-bold mb-1">
                                                {{ $rOptions['label'] ?? ucfirst($rField) }}
                                            </label>

                                            @switch($rOptions['type'] ?? 'text')
                                                @case('textarea')
                                                    <textarea
                                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline {{ $rField == 'description' || $rField == 'additional_info' ? 'description-editor' : '' }}"
                                                        name="related_{{ $relation }}[__INDEX__][{{ $rField }}]"
                                                        id="related_{{ $relation }}___INDEX___{{ $rField }}"
                                                        rows="3"
                                                    ></textarea>
                                                    @break

                                                @case('select')
                                                    <select
                                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                                        name="related_{{ $relation }}[__INDEX__][{{ $rField }}]"
                                                    >
                                                        @foreach($rOptions['options'] ?? [] as $value => $label)
                                                            <option value="{{ $value }}">{{ $label }}</option>
                                                        @endforeach
                                                    </select>
                                                    @break

                                                @default
                                                    <input
                                                        type="{{ $rOptions['type'] ?? 'text' }}"
                                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                                        name="related_{{ $relation }}[__INDEX__][{{ $rField }}]"
                                                        value=""
                                                    >
                                            @endswitch
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @else
                            <!-- Single Related Item (1-1) -->
                            <div class="bg-gray-50 p-4 rounded-lg">
                                @foreach($relationFields as $rField => $rOptions)
                                    <div class="mb-4">
                                        <label class="block text-gray-700 text-sm font-bold mb-2">
                                            {{ $rOptions['label'] ?? ucfirst($rField) }}
                                        </label>

                                        @switch($rOptions['type'] ?? 'text')
                                            @case('textarea')
                                                <textarea
                                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline {{ $rField == 'description' || $rField == 'additional_info' ? 'description-editor' : '' }}"
                                                    name="related_{{ $relation }}[{{ $rField }}]"
                                                    id="related_{{ $relation }}_{{ $rField }}"
                                                    rows="4"
                                                >{{ old("related_{$relation}.{$rField}", isset($related_items[$relation]) ? $related_items[$relation]->$rField : '') }}</textarea>
                                                @break

                                            @case('select')
                                                <select
                                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                                    name="related_{{ $relation }}[{{ $rField }}]"
                                                >
                                                    @foreach($rOptions['options'] ?? [] as $value => $label)
                                                        <option value="{{ $value }}" {{ old("related_{$relation}.{$rField}", isset($related_items[$relation]) ? $related_items[$relation]->$rField : '') == $value ? 'selected' : '' }}>
                                                            {{ $label }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @break

                                            @default
                                                <input
                                                    type="{{ $rOptions['type'] ?? 'text' }}"
                                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                                    name="related_{{ $relation }}[{{ $rField }}]"
                                                    value="{{ old("related_{$relation}.{$rField}", isset($related_items[$relation]) ? $related_items[$relation]->$rField : '') }}"
                                                >
                                        @endswitch

                                        @error("related_{$relation}.{$rField}")
                                            <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                @endforeach
            @endif

            <div class="flex items-center justify-between mt-6">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    {{ isset($item) ? 'Update' : 'Create' }}
                </button>
                <a href="{{ route($route.'.index') }}" class="text-gray-600 hover:text-gray-800">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
    // Store temporary files
    let tempFiles = {};

    document.addEventListener('DOMContentLoaded', function() {

        // Lấy tất cả các nút thêm mới
        var addButtons = document.querySelectorAll('.add-related-btn');

        // Gán sự kiện click cho mỗi nút thêm
        addButtons.forEach(function(button) {
            button.addEventListener('click', function(e) {
                e.preventDefault();

                var relation = this.getAttribute('data-relation');
                var container = document.getElementById('container-' + relation);
                var template = document.getElementById('template-' + relation);

                if (!container || !template) {
                    console.error('Container or template not found');
                    return;
                }

                // Đếm số lượng item hiện tại
                var itemCount = container.querySelectorAll('.related-item').length;

                // Clone template
                var newItemTemplate = template.querySelector('.related-item');
                var newItem = newItemTemplate.cloneNode(true);

                // Cập nhật index trong các trường input
                var inputs = newItem.querySelectorAll('textarea, input, select');
                inputs.forEach(function(input) {
                    var name = input.getAttribute('name');
                    if (name) {
                        input.setAttribute('name', name.replace('__INDEX__', itemCount));
                    }

                    // Cập nhật ID nếu có
                    var id = input.getAttribute('id');
                    if (id) {
                        input.setAttribute('id', id.replace('__INDEX__', itemCount));
                    }
                });

                // Cập nhật tiêu đề
                var title = newItem.querySelector('h4');
                if (title) {
                    title.textContent = 'Item #' + (itemCount + 1);
                }

                // Thêm vào container
                container.appendChild(newItem);

                // Khởi tạo lại sự kiện cho nút xóa
                initRemoveButtons();

                // Khởi tạo lại trình soạn thảo văn bản nếu có
                var editors = newItem.querySelectorAll('textarea.description-editor, textarea.description-simple');
                if (editors.length > 0 && typeof $ !== 'undefined') {
                    editors.forEach(function(textarea) {
                        // Lưu ID và name của textarea gốc
                        var originalId = textarea.id;
                        var originalName = textarea.name;
                        var originalValue = textarea.value;

                        // Đảm bảo ID không trùng nếu có
                        textarea.id = originalId.replace(/__INDEX__/g, itemCount);

                        // Tạo một container div bao quanh textarea
                        var container = document.createElement('div');
                        container.className = 'summernote-container';
                        textarea.parentNode.insertBefore(container, textarea);

                        // Đưa textarea vào container và ẩn nó đi
                        container.appendChild(textarea);
                        textarea.style.display = 'none';

                        // Tạo div để làm editor
                        var editorDiv = document.createElement('div');
                        editorDiv.className = textarea.classList.contains('description-simple') ?
                            'summernote-editor-simple' : 'summernote-editor';
                        editorDiv.innerHTML = originalValue;
                        container.appendChild(editorDiv);

                        // Xác định loại editor
                        if (textarea.classList.contains('description-simple')) {
                            // Khởi tạo Summernote đơn giản
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
                                        textarea.value = contents;
                                    }
                                }
                            });
                        } else {
                            // Khởi tạo Summernote đầy đủ
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
                                        textarea.value = contents;
                                    }
                                }
                            });
                        }
                    });
                }
            });
        });

        // Khởi tạo sự kiện cho các nút xóa
        function initRemoveButtons() {
            var removeButtons = document.querySelectorAll('.remove-related-btn');

            removeButtons.forEach(function(button) {
                // Xóa event listener cũ (nếu có) bằng cách clone và thay thế button
                var newButton = button.cloneNode(true);
                if (button.parentNode) {
                    button.parentNode.replaceChild(newButton, button);
                }

                // Thêm event listener mới
                newButton.addEventListener('click', function(e) {
                    e.preventDefault();

                    var item = this.closest('.related-item');
                    var container = item.parentNode;

                    // Nếu là item cuối cùng thì chỉ xóa giá trị
                    if (container.querySelectorAll('.related-item').length <= 1) {

                        var inputs = item.querySelectorAll('input, textarea, select');
                        inputs.forEach(function(input) {
                            if (input.type === 'checkbox' || input.type === 'radio') {
                                input.checked = false;
                            } else {
                                input.value = '';

                                // Nếu là trình soạn thảo Summernote, xóa nội dung
                                if ((input.classList.contains('description-editor') || input.classList.contains('description-simple')) && typeof $ !== 'undefined') {
                                    // Tìm parent .summernote-container
                                    var container = input.closest('.summernote-container');
                                    if (container) {
                                        var editor = container.querySelector('.summernote-editor, .summernote-editor-simple');
                                        if (editor) {
                                            try {
                                                $(editor).summernote('code', ''); // Xóa nội dung
                                            } catch(e) {
                                                console.error('Error clearing Summernote:', e);
                                            }
                                        }
                                    }
                                }
                            }
                        });
                    } else {

                        // Hủy các editor trước khi xóa phần tử
                        if (typeof $ !== 'undefined') {
                            var editorContainers = item.querySelectorAll('.summernote-container');
                            if (editorContainers.length > 0) {
                                editorContainers.forEach(function(container) {
                                    var editor = container.querySelector('.summernote-editor, .summernote-editor-simple');
                                    if (editor) {
                                        try {
                                            $(editor).summernote('destroy');
                                        } catch(e) {
                                            console.error('Error destroying Summernote:', e);
                                        }
                                    }
                                });
                            }
                        }

                        container.removeChild(item);

                        // Cập nhật lại các index
                        updateItemIndices(container);
                    }
                });
            });
        }

        // Update the updateItemIndices function
        function updateItemIndices(container) {

            var items = container.querySelectorAll('.related-item');

            items.forEach(function(item, index) {
                // Update title
                var title = item.querySelector('h4');
                if (title) {
                    title.textContent = 'Item #' + (index + 1);
                }

                // Update input names and IDs
                var inputs = item.querySelectorAll('input, textarea, select');
                inputs.forEach(function(input) {
                    // Destroy Summernote if it exists
                    var name = input.getAttribute('name');
                    if (name) {
                        var newName = name.replace(/\[(\d+)\]/, '[' + index + ']');
                        input.setAttribute('name', newName);
                    }

                    var id = input.getAttribute('id');
                    if (id) {
                        var newId = id.replace(/_(\d+)_/, '_' + index + '_');
                        input.setAttribute('id', newId);
                    }
                });
            });
        }

        // Khởi tạo sự kiện cho các nút xóa khi trang được tải
        initRemoveButtons();
    });

    function handleMediaPreview(input) {
        const container = input.closest('.media-upload-container');
        const previewBox = container.querySelector('.preview-box');
        const placeholder = container.querySelector('.upload-placeholder');
        const fileInfo = container.querySelector('.file-info');
        const fileNameElement = container.querySelector('.selected-file-name');

        if (input.files && input.files[0]) {
            const file = input.files[0];
            const reader = new FileReader();

            // Store file in temporary storage
            tempFiles[input.id] = file;

            // Show file name
            fileNameElement.textContent = file.name;
            fileInfo.classList.remove('hidden');
            placeholder.classList.add('hidden');

            // Handle preview based on file type
            if (file.type.startsWith('image/')) {
                reader.onload = function(e) {
                    previewBox.innerHTML = `<img src="${e.target.result}" class="max-h-48 mx-auto rounded-lg shadow-sm" alt="Preview">`;
                    previewBox.classList.remove('hidden');
                };
                reader.readAsDataURL(file);
            }
            else if (file.type.startsWith('video/')) {
                reader.onload = function(e) {
                    previewBox.innerHTML = `<video src="${e.target.result}" class="max-h-48 mx-auto rounded-lg shadow-sm" controls></video>`;
                    previewBox.classList.remove('hidden');
                };
                reader.readAsDataURL(file);
            }
            else if (file.type.startsWith('audio/')) {
                reader.onload = function(e) {
                    previewBox.innerHTML = `<audio src="${e.target.result}" class="w-full" controls></audio>`;
                    previewBox.classList.remove('hidden');
                };
                reader.readAsDataURL(file);
            }

            // Store preview data in localStorage
            reader.onloadend = function() {
                try {
                    localStorage.setItem(`preview_${input.id}`, reader.result);
                    localStorage.setItem(`filename_${input.id}`, file.name);
                    localStorage.setItem(`filetype_${input.id}`, file.type);
                } catch (e) {
                    console.warn('Failed to store preview in localStorage:', e);
                }
            };
        }
    }

    function removeMedia(button, fieldName) {
        const container = button.closest('.media-upload-container');
        const input = container.querySelector('.media-input');
        const previewBox = container.querySelector('.preview-box');
        const placeholder = container.querySelector('.upload-placeholder');
        const fileInfo = container.querySelector('.file-info');

        // Clear input and temporary storage
        input.value = '';
        delete tempFiles[input.id];
        localStorage.removeItem(`preview_${input.id}`);
        localStorage.removeItem(`filename_${input.id}`);
        localStorage.removeItem(`filetype_${input.id}`);

        // Reset preview
        previewBox.innerHTML = '';
        previewBox.classList.add('hidden');

        // Show placeholder
        placeholder.classList.remove('hidden');

        // Hide file info
        fileInfo.classList.add('hidden');

        // If you want to remove the existing file on the server when editing
        if (document.querySelector('input[name="_method"]')?.value === 'PUT') {
            // Add a hidden input to indicate file removal
            const hiddenInput = document.createElement('input');
            hiddenInput.type = 'hidden';
            hiddenInput.name = `remove_${fieldName}`;
            hiddenInput.value = '1';
            container.appendChild(hiddenInput);
        }
    }

    // Handle drag and drop
    document.querySelectorAll('.media-preview-container').forEach(container => {
        container.addEventListener('dragover', (e) => {
            e.preventDefault();
            container.classList.add('border-blue-500');
        });

        container.addEventListener('dragleave', (e) => {
            e.preventDefault();
            container.classList.remove('border-blue-500');
        });

        container.addEventListener('drop', (e) => {
            e.preventDefault();
            container.classList.remove('border-blue-500');

            const input = container.closest('.media-upload-container').querySelector('.media-input');
            const dt = e.dataTransfer;
            const files = dt.files;

            input.files = files;
            handleMediaPreview(input);
        });
    });

    // Restore previews from localStorage on page load
    document.addEventListener('DOMContentLoaded', () => {
        document.querySelectorAll('.media-input').forEach(input => {
            const previewData = localStorage.getItem(`preview_${input.id}`);
            const fileName = localStorage.getItem(`filename_${input.id}`);
            const fileType = localStorage.getItem(`filetype_${input.id}`);

            if (previewData && fileName && fileType) {
                const container = input.closest('.media-upload-container');
                const previewBox = container.querySelector('.preview-box');
                const placeholder = container.querySelector('.upload-placeholder');
                const fileInfo = container.querySelector('.file-info');
                const fileNameElement = container.querySelector('.selected-file-name');

                // Show file name
                fileNameElement.textContent = fileName;
                fileInfo.classList.remove('hidden');
                placeholder.classList.add('hidden');

                // Show preview based on file type
                if (fileType.startsWith('image/')) {
                    previewBox.innerHTML = `<img src="${previewData}" class="max-h-48 mx-auto rounded-lg shadow-sm" alt="Preview">`;
                } else if (fileType.startsWith('video/')) {
                    previewBox.innerHTML = `<video src="${previewData}" class="max-h-48 mx-auto rounded-lg shadow-sm" controls></video>`;
                } else if (fileType.startsWith('audio/')) {
                    previewBox.innerHTML = `<audio src="${previewData}" class="w-full" controls></audio>`;
                }
                previewBox.classList.remove('hidden');

                // Create a new File object from the stored data
                fetch(previewData)
                    .then(res => res.blob())
                    .then(blob => {
                        const file = new File([blob], fileName, { type: fileType });
                        tempFiles[input.id] = file;

                        // Create a new FileList-like object
                        const dataTransfer = new DataTransfer();
                        dataTransfer.items.add(file);
                        input.files = dataTransfer.files;
                    });
            }
        });

        // Clear localStorage after restoring previews
        const formElement = document.querySelector('form');
        formElement.addEventListener('submit', () => {
            document.querySelectorAll('.media-input').forEach(input => {
                localStorage.removeItem(`preview_${input.id}`);
                localStorage.removeItem(`filename_${input.id}`);
                localStorage.removeItem(`filetype_${input.id}`);
            });
        });
    });

    // Add new function to handle field dependencies
    function handleFieldDependencies() {
        const dependentFields = document.querySelectorAll('[data-depends-on]');

        dependentFields.forEach(field => {
            const dependsOn = field.getAttribute('data-depends-on');
            const dependsValues = JSON.parse(field.getAttribute('data-depends-values'));
            const showIfIn = field.getAttribute('data-show-if-in') === 'true';
            const controlField = document.querySelector(`[data-field="${dependsOn}"] select, [data-field="${dependsOn}"] input`);

            if (controlField) {
                // Initial check
                checkDependency(field, controlField, dependsValues, showIfIn);

                // Add change event listener
                controlField.addEventListener('change', () => {
                    checkDependency(field, controlField, dependsValues, showIfIn);
                });
            }
        });
    }

    function checkDependency(field, controlField, dependsValues, showIfIn) {
        const currentValue = controlField.value;
        const shouldShow = showIfIn ?
            dependsValues.includes(currentValue) :
            !dependsValues.includes(currentValue);

        field.style.display = shouldShow ? 'block' : 'none';

        // If field is hidden, clear its value
        if (!shouldShow) {
            const inputs = field.querySelectorAll('input, select, textarea');
            inputs.forEach(input => {
                if (input.type === 'checkbox' || input.type === 'radio') {
                    input.checked = false;
                } else {
                    input.value = '';
                }
            });
        }
    }

    // Call the function when document is ready
    document.addEventListener('DOMContentLoaded', function() {
        handleFieldDependencies();
        // ... other existing DOMContentLoaded handlers ...
    });
</script>
@endpush
@endsection
