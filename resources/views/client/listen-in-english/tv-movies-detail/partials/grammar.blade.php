<div class="grammar-content">
    <h5>Grammar <small class="text-muted">(aux. verbs)</small></h5>

    <div class="directions mb-4">
        <strong>Directions:</strong>
        1) Read these sentences from the video and choose the word or expression that you think fits best.
        2) Listen again and check your answers.
    </div>

    <form id="grammarForm">
        <ul class="list-unstyled">
            <li class="mb-3">
                You
                <select class="form-select d-inline-block w-auto">
                    <option value="">--</option>
                    <option value="are">are</option>
                    <option value="is">is</option>
                    <option value="am">am</option>
                </select>
                looking great.
            </li>

            <li class="mb-3">
                Hey, it
                <select class="form-select d-inline-block w-auto">
                    <option value="">--</option>
                    <option value="is">is</option>
                    <option value="are">are</option>
                    <option value="be">be</option>
                </select>
                starting to rain.
            </li>

            <li class="mb-3">
                <select class="form-select d-inline-block w-auto">
                    <option value="">--</option>
                    <option value="Would">Would</option>
                    <option value="Will">Will</option>
                    <option value="Do">Do</option>
                </select>
                you like a coffee?
            </li>

            <li class="mb-3">
                Oh, thanks, Steve, but I
                <select class="form-select d-inline-block w-auto">
                    <option value="">--</option>
                    <option value="have">have</option>
                    <option value="has">has</option>
                    <option value="had">had</option>
                </select>
                a meeting in an hour.
            </li>

            <li class="mb-3">
                Oh, come on, Jenny. I
                <select class="form-select d-inline-block w-auto">
                    <option value="">--</option>
                    <option value="would">would</option>
                    <option value="will">will</option>
                    <option value="should">should</option>
                </select>
                like to talk to you.
            </li>

            <li class="mb-3">
                Jenny, I
                <select class="form-select d-inline-block w-auto">
                    <option value="">--</option>
                    <option value="would">would</option>
                    <option value="will">will</option>
                    <option value="should">should</option>
                </select>
                like to ask you something.
            </li>

            <li class="mb-3">
                There
                <select class="form-select d-inline-block w-auto">
                    <option value="">--</option>
                    <option value="is">is</option>
                    <option value="are">are</option>
                    <option value="be">be</option>
                </select>
                an exhibition of Picasso at the MoMA next week.
            </li>

            <li class="mb-3">
                I know you love Picasso.
                <select class="form-select d-inline-block w-auto">
                    <option value="">--</option>
                    <option value="Would">Would</option>
                    <option value="Will">Will</option>
                    <option value="Should">Should</option>
                </select>
                you like to come with me?
            </li>

            <li class="mb-3">
                Listen Steve, I
                <select class="form-select d-inline-block w-auto">
                    <option value="">--</option>
                    <option value="am">am</option>
                    <option value="is">is</option>
                    <option value="are">are</option>
                </select>
                really busy at work at the moment.
            </li>

            <li class="mb-3">
                Next week
                <select class="form-select d-inline-block w-auto">
                    <option value="">--</option>
                    <option value="is">is</option>
                    <option value="will be">will be</option>
                    <option value="would be">would be</option>
                </select>
                a good week for me.
            </li>

            <li class="mb-3">
                Maybe we
                <select class="form-select d-inline-block w-auto">
                    <option value="">--</option>
                    <option value="could">could</option>
                    <option value="should">should</option>
                    <option value="would">would</option>
                </select>
                meet one evening when you
                <select class="form-select d-inline-block w-auto">
                    <option value="">--</option>
                    <option value="have">have</option>
                    <option value="has">has</option>
                    <option value="had">had</option>
                </select>
                more time and
                <select class="form-select d-inline-block w-auto">
                    <option value="">--</option>
                    <option value="have">have</option>
                    <option value="has">has</option>
                    <option value="had">had</option>
                </select>
                dinner or see a show?
            </li>

            <li class="mb-3">
                Listen Steve, I
                <select class="form-select d-inline-block w-auto">
                    <option value="">--</option>
                    <option value="don't">don't</option>
                    <option value="doesn't">doesn't</option>
                    <option value="didn't">didn't</option>
                </select>
                think it's a good idea, but thanks.
            </li>
        </ul>

        <div class="d-flex gap-2">
            <button type="button" class="btn btn-primary" onclick="showAnswers()">Show Answers</button>
            <button type="button" class="btn btn-secondary" onclick="hideAnswers()">Hide Answers</button>
        </div>
    </form>
</div>

@push('styles')
<style>
    .form-select {
        width: 120px !important;
        display: inline-block !important;
        margin: 0 5px;
    }

    .correct {
        background-color: #d4edda;
        border-color: #c3e6cb;
    }

    .incorrect {
        background-color: #f8d7da;
        border-color: #f5c6cb;
    }
</style>
@endpush

@push('scripts')
<script>
const answers = {
    0: 'are',
    1: 'is',
    2: 'Would',
    3: 'have',
    4: 'would',
    5: 'would',
    6: 'is',
    7: 'Would',
    8: 'am',
    9: 'will be',
    10: 'could',
    11: 'have',
    12: 'have',
    13: "don't"
};

function showAnswers() {
    const selects = document.querySelectorAll('#grammarForm select');
    selects.forEach((select, index) => {
        select.value = answers[index];
        select.classList.add('correct');
    });
}

function hideAnswers() {
    const selects = document.querySelectorAll('#grammarForm select');
    selects.forEach(select => {
        select.value = '';
        select.classList.remove('correct', 'incorrect');
    });
}

// Optional: Add check answer functionality for each select
document.querySelectorAll('#grammarForm select').forEach((select, index) => {
    select.addEventListener('change', function() {
        if (this.value === answers[index]) {
            this.classList.add('correct');
            this.classList.remove('incorrect');
        } else if (this.value !== '') {
            this.classList.add('incorrect');
            this.classList.remove('correct');
        } else {
            this.classList.remove('correct', 'incorrect');
        }
    });
});
</script>
@endpush
