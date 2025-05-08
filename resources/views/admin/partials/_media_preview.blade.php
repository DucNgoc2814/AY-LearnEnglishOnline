@php
    $mediaUrl = $model->{$field.'_url'};
    $mediaType = $model->getFieldType($field);
@endphp

@if($mediaUrl)
    <div class="media-preview mb-2">
        @if($mediaType === 'image')
            <img src="{{ $mediaUrl }}" alt="{{ $model->getFieldLabel($field) }}"
                 class="max-w-xs h-auto rounded shadow-sm">
        @elseif($mediaType === 'file' && str_contains($field, 'video'))
            <video controls class="max-w-xs h-auto rounded shadow-sm">
                <source src="{{ $mediaUrl }}" type="video/mp4">
                Your browser does not support the video tag.
            </video>
        @elseif($mediaType === 'file' && str_contains($field, 'audio'))
            <audio controls class="w-full max-w-xs">
                <source src="{{ $mediaUrl }}" type="audio/mpeg">
                Your browser does not support the audio tag.
            </audio>
        @else
            <a href="{{ $mediaUrl }}" target="_blank"
               class="text-blue-600 hover:text-blue-800 underline">
                View File
            </a>
        @endif
    </div>
@endif
