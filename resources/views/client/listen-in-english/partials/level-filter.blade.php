<div class="level-filter mb-4">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title mb-3">Filter by Level</h5>
                        <form action="" method="GET" id="levelFilterForm">
                            <div class="d-flex gap-3 flex-wrap justify-content-center">
                                @php
                                    $levels = isset($levels) ? $levels : ['Beginner', 'Intermediate', 'Advanced'];
                                    $currentLevel = request()->get('level', '');
                                @endphp

                                <button type="button"
                                        class="btn {{ empty($currentLevel) ? 'btn-primary' : 'btn-outline-primary' }}"
                                        data-level="">
                                    All Levels
                                </button>

                                @foreach($levels as $level)
                                    <button type="button"
                                            class="btn {{ $currentLevel == $level ? 'btn-primary' : 'btn-outline-primary' }}"
                                            data-level="{{ $level }}">
                                        {{ $level }}
                                    </button>
                                @endforeach
                            </div>
                            <input type="hidden" name="level" id="selectedLevel" value="{{ $currentLevel }}">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const filterForm = document.getElementById('levelFilterForm');
    const levelInput = document.getElementById('selectedLevel');
    const levelButtons = document.querySelectorAll('.level-filter button');

    levelButtons.forEach(button => {
        button.addEventListener('click', function() {
            const level = this.getAttribute('data-level');
            levelInput.value = level;
            filterForm.submit();
        });
    });
});
</script>
@endpush
