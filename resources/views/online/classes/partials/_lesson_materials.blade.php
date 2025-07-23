@php
    $courseType = $courseType ?? 'basic';
    $lessons = config("course_structure.courses.{$courseType}.lessons");
@endphp

<style>
    .materials-container .accordion-button {
        background-color: transparent !important;
        box-shadow: none !important;
    }
    .materials-container .accordion-button:focus {
        box-shadow: none !important;
        border-color: rgba(0,0,0,.125) !important;
    }
    .materials-container .lesson-item > .accordion-header > .accordion-button {
        background-color: #fff !important;
        font-weight: 600;
        font-size: 1.1rem;
    }
    .materials-container .level-1 {
        margin-left: 1.5rem;
        border-left: 2px solid #e9ecef;
    }
    .materials-container .level-1 > .accordion-header > .accordion-button {
        background-color: #e3f2fd !important;
        font-weight: 600;
    }
    .materials-container .level-2 {
        margin-left: 3rem;
        border-left: 2px solid #e9ecef;
    }
    .materials-container .level-2 > .accordion-header > .accordion-button {
        background-color: #f8f9fa !important;
    }
    .materials-container .level-3 {
        margin-left: 4.5rem;
    }
    .materials-container .accordion-item {
        border: none;
    }
    .materials-container .list-group-item {
        border-left: none;
        border-right: none;
    }
    .materials-container .btn-outline-primary:focus {
        box-shadow: none !important;
    }
    .materials-container .btn-outline-primary:hover {
        background-color: #f8f9fa;
        color: #0d6efd;
        border-color: #0d6efd;
    }
    .materials-container .level-1,
    .materials-container .level-2 {
        position: relative;
    }
    .materials-container .level-1::before,
    .materials-container .level-2::before {
        content: '';
        position: absolute;
        left: -2px;
        top: 0;
        bottom: 0;
        width: 2px;
        background-color: #e9ecef;
    }
</style>

<div class="materials-container">
    <div class="accordion" id="lessonsAccordion">
        @foreach($lessons as $lesson)
            <div class="accordion-item mb-3">
                <h2 class="accordion-header">
                    <button class="accordion-button {{ $loop->first ? '' : 'collapsed' }}" type="button"
                            data-bs-toggle="collapse"
                            data-bs-target="#lesson{{ $lesson['id'] }}"
                            aria-expanded="{{ $loop->first ? 'true' : 'false' }}">
                        <i class="fas fa-book me-2"></i> {{ $lesson['name'] }}
                    </button>
                </h2>
                <div id="lesson{{ $lesson['id'] }}"
                     class="accordion-collapse collapse {{ $loop->first ? 'show' : '' }}"
                     data-bs-parent="#lessonsAccordion">
                    <div class="accordion-body p-0">
                        <div class="accordion" id="lesson{{ $lesson['id'] }}Materials">
                            @foreach(['before_class' => 'BEFORE CLASS', 'during_class' => 'DURING CLASS', 'after_class' => 'AFTER CLASS'] as $section => $title)
                                @if(isset($lesson['structure'][$section]) && count($lesson['structure'][$section]) > 0)
                                    <div class="accordion-item mb-3 level-1">
                                        <h2 class="accordion-header">
                                            <button class="accordion-button {{ $loop->first ? '' : 'collapsed' }}"
                                                    type="button"
                                                    data-bs-toggle="collapse"
                                                    data-bs-target="#{{ $section }}Materials{{ $lesson['id'] }}"
                                                    aria-expanded="{{ $loop->first ? 'true' : 'false' }}">
                                                <i class="fas fa-hourglass-{{ $loop->first ? 'start' : ($loop->last ? 'end' : 'half') }} me-2"></i>
                                                {{ $title }}
                                            </button>
                                        </h2>
                                        <div id="{{ $section }}Materials{{ $lesson['id'] }}"
                                             class="accordion-collapse collapse {{ $loop->first ? 'show' : '' }}"
                                             data-bs-parent="#lesson{{ $lesson['id'] }}Materials">
                                            <div class="accordion-body p-0">
                                                <div class="accordion" id="{{ $section }}LessonsAccordion{{ $lesson['id'] }}">
                                                    @foreach($lesson['structure'][$section] as $key => $item)
                                                        <div class="accordion-item level-2">
                                                            <h2 class="accordion-header">
                                                                <button class="accordion-button {{ $loop->first ? '' : 'collapsed' }}"
                                                                        type="button"
                                                                        data-bs-toggle="collapse"
                                                                        data-bs-target="#{{ $key }}{{ $lesson['id'] }}"
                                                                        aria-expanded="{{ $loop->first ? 'true' : 'false' }}">
                                                                    <i class="{{ $item['icon'] }} me-2"></i> {{ $item['title'] }}
                                                                </button>
                                                            </h2>
                                                            <div id="{{ $key }}{{ $lesson['id'] }}"
                                                                 class="accordion-collapse collapse {{ $loop->first ? 'show' : '' }}"
                                                                 data-bs-parent="#{{ $section }}LessonsAccordion{{ $lesson['id'] }}">
                                                                <div class="list-group list-group-flush level-3">
                                                                    <div class="list-group-item d-flex gap-3 py-3">
                                                                        <div class="d-flex align-items-center justify-content-center flex-shrink-0"
                                                                             style="width: 42px; height: 42px; background-color: #f8f9fa; border-radius: 8px;">
                                                                            <i class="{{ $item['icon'] }} {{ $item['icon_color'] }}"></i>
                                                                        </div>
                                                                        <div class="d-flex w-100 justify-content-between">
                                                                            <div>
                                                                                <h6 class="mb-0">{{ $item['title'] }}</h6>
                                                                                <p class="mb-0 small text-muted">{{ $item['description'] }}</p>
                                                                            </div>
                                                                            <div class="d-flex flex-column align-items-end">
                                                                                <div class="btn-group">
                                                                                    @php
                                                                                        $routeParams = ['id' => $lesson['id']]; // Always include lesson id
                                                                                        foreach ($item as $paramKey => $paramValue) {
                                                                                            if (str_ends_with($paramKey, '_id')) {
                                                                                                $key = str_replace('_id', '', $paramKey);
                                                                                                if ($key !== 'id') { // Skip if it would override the lesson id
                                                                                                    $routeParams[$key] = $paramValue;
                                                                                                }
                                                                                            }
                                                                                        }
                                                                                    @endphp
                                                                                    <a href="{{ route($item['route'], $routeParams) }}"
                                                                                       class="btn btn-sm btn-outline-primary">
                                                                                        <i class="fas fa-play"></i> Start now!
                                                                                    </a>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
