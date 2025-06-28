<div class="sentence-building-content">
    <h5>Sentence Building <sup>[1]</sup></h5>

    <div class="directions mb-4">
        <strong>Directions:</strong> Write sentences about the video clip using the words given. You can change the word
        forms or add words, but you cannot change the word order. <a href="#" class="text-primary">View example</a>
        <div class="small text-muted mt-1">
            [1] - optional | * - necessary
        </div>
    </div>

    <div id="sentenceBuildingForm">
        <!-- Sentence 1 -->
        <div class="sentence-group mb-4">
            <div class="fw-bold mb-2">Sentence 1</div>
            <div class="word-bank mb-2">
                <span class="text-muted">jenny / friend / am / sits / after / arrest</span>
            </div>
            <div class="input-group mb-2">
                <input type="text" class="form-control" placeholder="Type your sentence here...">
            </div>
            <div class="d-flex gap-2">
                <button class="btn btn-primary btn-sm show-answer-btn">Show Answer</button>
                <button class="btn btn-secondary btn-sm hide-answer-btn" style="display: none;">Hide Answer</button>
            </div>
            <div class="answer-text mt-2 text-success" style="display: none;"></div>
        </div>

        <!-- Sentence 2 -->
        <div class="sentence-group mb-4">
            <div class="fw-bold mb-2">Sentence 2</div>
            <div class="word-bank mb-2">
                <span class="text-muted">when / I / start / run / then / suggest / get / coffee</span>
            </div>
            <div class="input-group mb-2">
                <input type="text" class="form-control" placeholder="Type your sentence here...">
            </div>
            <div class="d-flex gap-2">
                <button class="btn btn-primary btn-sm show-answer-btn">Show Answer</button>
                <button class="btn btn-secondary btn-sm hide-answer-btn" style="display: none;">Hide Answer</button>
            </div>
            <div class="answer-text mt-2 text-success" style="display: none;"></div>
        </div>

        <!-- Sentence 3 -->
        <div class="sentence-group mb-4">
            <div class="fw-bold mb-2">Sentence 3</div>
            <div class="word-bank mb-2">
                <span class="text-muted">steve / nervous / invite / come / sit / exhibition / next / week</span>
            </div>
            <div class="input-group mb-2">
                <input type="text" class="form-control" placeholder="Type your sentence here...">
            </div>
            <div class="d-flex gap-2">
                <button class="btn btn-primary btn-sm show-answer-btn">Show Answer</button>
                <button class="btn btn-secondary btn-sm hide-answer-btn" style="display: none;">Hide Answer</button>
            </div>
            <div class="answer-text mt-2 text-success" style="display: none;"></div>
        </div>

        <!-- Sentence 4 -->
        <div class="sentence-group mb-4">
            <div class="fw-bold mb-2">Sentence 4</div>
            <div class="word-bank mb-2">
                <span class="text-muted">jenny / turn / him / down</span>
            </div>
            <div class="input-group mb-2">
                <input type="text" class="form-control" placeholder="Type your sentence here...">
            </div>
            <div class="d-flex gap-2">
                <button class="btn btn-primary btn-sm show-answer-btn">Show Answer</button>
                <button class="btn btn-secondary btn-sm hide-answer-btn" style="display: none;">Hide Answer</button>
            </div>
            <div class="answer-text mt-2 text-success" style="display: none;"></div>
        </div>

        <!-- Sentence 5 -->
        <div class="sentence-group mb-4">
            <div class="fw-bold mb-2">Sentence 5</div>
            <div class="word-bank mb-2">
                <span class="text-muted">steve / feel / hurt / Jenny / get / dinner / or / do / show / sometime</span>
            </div>
            <div class="input-group mb-2">
                <input type="text" class="form-control" placeholder="Type your sentence here...">
            </div>
            <div class="d-flex gap-2">
                <button class="btn btn-primary btn-sm show-answer-btn">Show Answer</button>
                <button class="btn btn-secondary btn-sm hide-answer-btn" style="display: none;">Hide Answer</button>
            </div>
            <div class="answer-text mt-2 text-success" style="display: none;"></div>
        </div>

        <!-- Sentence 6 -->
        <div class="sentence-group mb-4">
            <div class="fw-bold mb-2">Sentence 6</div>
            <div class="word-bank mb-2">
                <span class="text-muted">jenny / turn / him / down / again</span>
            </div>
            <div class="input-group mb-2">
                <input type="text" class="form-control" placeholder="Type your sentence here...">
            </div>
            <div class="d-flex gap-2">
                <button class="btn btn-primary btn-sm show-answer-btn">Show Answer</button>
                <button class="btn btn-secondary btn-sm hide-answer-btn" style="display: none;">Hide Answer</button>
            </div>
            <div class="answer-text mt-2 text-success" style="display: none;"></div>
        </div>

        <!-- Sentence 7 -->
        <div class="sentence-group mb-4">
            <div class="fw-bold mb-2">Sentence 7</div>
            <div class="word-bank mb-2">
                <span class="text-muted">jenny / sad / tell / steve / she / have to / leave</span>
            </div>
            <div class="input-group mb-2">
                <input type="text" class="form-control" placeholder="Type your sentence here...">
            </div>
            <div class="d-flex gap-2">
                <button class="btn btn-primary btn-sm show-answer-btn">Show Answer</button>
                <button class="btn btn-secondary btn-sm hide-answer-btn" style="display: none;">Hide Answer</button>
            </div>
            <div class="answer-text mt-2 text-success" style="display: none;"></div>
        </div>
    </div>
</div>

@push('styles')
    <style>
        .word-bank {
            font-family: monospace;
            padding: 8px;
            background-color: #f8f9fa;
            border-radius: 4px;
        }

        .sentence-group {
            padding: 15px;
            border: 1px solid #dee2e6;
            border-radius: 8px;
            margin-bottom: 1rem;
        }

        .sentence-group:hover {
            background-color: #f8f9fa;
        }

        .answer-text {
            font-weight: 500;
            color: #28a745;
            padding: 8px;
            border-radius: 4px;
            background-color: #f8f9fa;
        }

        .show-answer-btn, .hide-answer-btn {
            min-width: 100px;
        }
    </style>
@endpush

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const answers = {
                0: ["Jenny sat after her friend was arrested", "Jenny sat down after her friend was arrested"],
                1: ["When I started running then I suggested getting coffee",
                    "When I started to run then I suggested getting a coffee"
                ],
                2: ["Steve was nervous to invite her to come to the exhibition next week",
                    "Steve nervously invited her to come to the exhibition next week"
                ],
                3: ["Jenny won't turn him down", "Jenny will not turn him down"],
                4: ["Steve felt hurt when Jenny suggested getting dinner or doing a show sometime",
                    "Steve was hurt when Jenny suggested getting dinner or doing a show sometime"
                ],
                5: ["Jenny turned him down again", "Jenny has turned him down again"],
                6: ["Jenny was sad to tell Steve she had to leave", "Jenny sadly told Steve she had to leave"]
            };

            // Add click handlers for show answer buttons
            document.querySelectorAll('.show-answer-btn').forEach((btn, index) => {
                btn.addEventListener('click', function() {
                    const group = this.closest('.sentence-group');
                    const hideBtn = group.querySelector('.hide-answer-btn');
                    const answerText = group.querySelector('.answer-text');

                    // Show the first correct answer
                    answerText.textContent = answers[index][0];

                    // Toggle buttons and answer visibility
                    this.style.display = 'none';
                    hideBtn.style.display = 'inline-block';
                    answerText.style.display = 'block';
                });
            });

            // Add click handlers for hide answer buttons
            document.querySelectorAll('.hide-answer-btn').forEach((btn) => {
                btn.addEventListener('click', function() {
                    const group = this.closest('.sentence-group');
                    const showBtn = group.querySelector('.show-answer-btn');
                    const answerText = group.querySelector('.answer-text');

                    // Toggle buttons and answer visibility
                    this.style.display = 'none';
                    showBtn.style.display = 'inline-block';
                    answerText.style.display = 'none';

                    // Clear the input
                    group.querySelector('input').value = '';
                });
            });
        });
    </script>
@endpush
