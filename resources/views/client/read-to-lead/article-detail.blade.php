@extends('client.layouts.master')

@section('title', $article['title'])

@section('content')
    <!-- Include Navigation Partial -->
    @include('client.read-to-lead.partials.navigation')

    <div class="main-content">
        <div class="container-fluid px-5">
            <!-- Article Header -->
            <div class="article-header mb-5">
                <div class="article-meta mb-4">
                    <span class="badge bg-primary me-2">{{ $article['category'] }}</span>
                    <span class="badge bg-secondary me-2">{{ $article['level'] }}</span>
                    <span class="text-muted"><i class="fas fa-clock me-1"></i>{{ $article['reading_time'] }}</span>
                </div>

                <h1 class="article-title display-4 mb-4">{{ $article['title'] }}</h1>
            </div>

            <div class="row">
                <div class="col-lg-8">
                    <!-- Article Content -->
                    <div class="article-content mb-5">
                        <div class="content-section mb-4">
                            <div class="d-flex justify-content-end mb-2">
                                <button class="btn btn-sm btn-outline-primary toggle-translation">
                                    <i class="fas fa-language me-1"></i>
                                    <span class="toggle-text">Show Vietnamese</span>
                                </button>
                            </div>
                            <p class="english-text">
                                <strong>Garlic</strong>, <strong>red radish</strong>, sweet potato, carrot, and <strong>beetroot</strong> are rich in <strong>antioxidants</strong>, which help prevent diseases, improve health, and combat aging.
                            </p>
                            <p class="vietnamese-text text-muted d-none">
                                Tỏi, củ cải đỏ, khoai lang, cà rốt và củ dền giàu chất chống oxy hóa, giúp ngăn ngừa bệnh tật, cải thiện sức khỏe và chống lão hóa.
                            </p>

                            <!-- Audio Player -->
                            <div class="audio-player mb-3">
                                <audio controls class="w-100">
                                    <source src="{{ asset('audio/paragraph1.mp3') }}" type="audio/mpeg">
                                    Your browser does not support the audio element.
                                </audio>
                            </div>
                        </div>

                        <div class="content-section mb-4">
                            <div class="d-flex justify-content-end mb-2">
                                <button class="btn btn-sm btn-outline-primary toggle-translation">
                                    <i class="fas fa-language me-1"></i>
                                    <span class="toggle-text">Show Vietnamese</span>
                                </button>
                            </div>
                            <p class="english-text">
                                According to Dr. Health San Vu from Chi Minh City Medicine and Pharmacy Hospital, <strong>antioxidants</strong> are <strong>abundantly</strong> found in fruits, vegetables, and <strong>herbs</strong>. Numerous studies have demonstrated their benefits in disease prevention, health improvement, and aging combat.
                            </p>
                            <p class="vietnamese-text text-muted d-none">
                                Theo Tiến sĩ Health San Vu từ Bệnh viện Y Dược TP.HCM, các chất chống oxy hóa có nhiều trong trái cây, rau củ và thảo mộc. Nhiều nghiên cứu đã chứng minh lợi ích của chúng trong việc phòng ngừa bệnh tật, cải thiện sức khỏe và chống lão hóa.
                            </p>

                            <!-- Audio Player -->
                            <div class="audio-player mb-3">
                                <audio controls class="w-100">
                                    <source src="{{ asset('audio/paragraph2.mp3') }}" type="audio/mpeg">
                                    Your browser does not support the audio element.
                                </audio>
                            </div>
                        </div>

                        <div class="content-section mb-4">
                            <div class="d-flex justify-content-end mb-2">
                                <button class="btn btn-sm btn-outline-primary toggle-translation">
                                    <i class="fas fa-language me-1"></i>
                                    <span class="toggle-text">Show Vietnamese</span>
                                </button>
                            </div>
                            <p class="english-text">
                                Below are the 5 vegetables rich in <strong>antioxidants</strong> as noted by Dr. Vu.
                            </p>
                            <p class="vietnamese-text text-muted d-none">
                                Dưới đây là 5 loại rau củ giàu chất chống oxy hóa theo ghi nhận của Tiến sĩ Vu.
                            </p>

                            <!-- Audio Player -->
                            <div class="audio-player mb-3">
                                <audio controls class="w-100">
                                    <source src="{{ asset('audio/paragraph3.mp3') }}" type="audio/mpeg">
                                    Your browser does not support the audio element.
                                </audio>
                            </div>
                        </div>

                        <div class="content-section mb-4">
                            <div class="d-flex justify-content-end mb-2">
                                <button class="btn btn-sm btn-outline-primary toggle-translation">
                                    <i class="fas fa-language me-1"></i>
                                    <span class="toggle-text">Show Vietnamese</span>
                                </button>
                            </div>
                            <p class="english-text">
                                Garlic supports heart health by reducing cholesterol and blood pressure. It boosts the <strong>immune system</strong>, aids in <strong>blood circulation</strong>, and plays a significant role in cancer prevention. Additionally, garlic helps maintain youthful skin <strong>elasticity</strong> and slows the aging process.
                            </p>
                            <p class="vietnamese-text text-muted d-none">
                                Tỏi hỗ trợ sức khỏe tim mạch bằng cách giảm cholesterol và huyết áp. Nó tăng cường hệ miễn dịch, hỗ trợ tuần hoàn máu và đóng vai trò quan trọng trong việc phòng ngừa ung thư. Ngoài ra, tỏi còn giúp duy trì độ đàn hồi của làn da trẻ trung và làm chậm quá trình lão hóa.
                            </p>

                            <!-- Audio Player -->
                            <div class="audio-player mb-3">
                                <audio controls class="w-100">
                                    <source src="{{ asset('audio/paragraph4.mp3') }}" type="audio/mpeg">
                                    Your browser does not support the audio element.
                                </audio>
                            </div>
                        </div>

                        <div class="content-section mb-4">
                            <div class="d-flex justify-content-end mb-2">
                                <button class="btn btn-sm btn-outline-primary toggle-translation">
                                    <i class="fas fa-language me-1"></i>
                                    <span class="toggle-text">Show Vietnamese</span>
                                </button>
                            </div>
                            <p class="english-text">
                                <strong>Red radish</strong> contains betanin and sulforaphane, which have <strong>antioxidant</strong>, <strong>anti-inflammatory</strong>, and <strong>detoxifying</strong> properties. It is also beneficial for vision and nervous tissues. Studies have shown that antioxidants can inhibit tumor growth and provide the breast, prostate, and colon cancer prevention effects of the breast.
                            </p>
                            <p class="vietnamese-text text-muted d-none">
                                Củ cải đỏ chứa betanin và sulforaphane, có đặc tính chống oxy hóa, chống viêm và giải độc. Nó cũng có lợi cho thị giác và các mô thần kinh. Các nghiên cứu đã chỉ ra rằng chất chống oxy hóa có thể ức chế sự phát triển của khối u và có tác dụng phòng ngừa ung thư vú, tuyến tiền liệt và đại tràng.
                            </p>

                            <!-- Audio Player -->
                            <div class="audio-player mb-3">
                                <audio controls class="w-100">
                                    <source src="{{ asset('audio/paragraph5.mp3') }}" type="audio/mpeg">
                                    Your browser does not support the audio element.
                                </audio>
                            </div>
                        </div>
                    </div>

                    <!-- Word Bank -->
                    <div class="word-bank mb-5">
                        <h3 class="section-title mb-4">Word Bank</h3>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th>Word</th>
                                        <th>Pronunciation</th>
                                        <th>Meaning</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>radish</td>
                                        <td>/ˈrædɪʃ/</td>
                                        <td>củ cải</td>
                                    </tr>
                                    <tr>
                                        <td>beetroot</td>
                                        <td>/ˈbiːtruːt/</td>
                                        <td>củ dền</td>
                                    </tr>
                                    <tr>
                                        <td>antioxidant</td>
                                        <td>/ˌæntiˈɒksɪdənt/</td>
                                        <td>chất chống oxy hóa</td>
                                    </tr>
                                    <tr>
                                        <td>abundant</td>
                                        <td>/əˈbʌndənt/</td>
                                        <td>nhiều, dồi dào</td>
                                    </tr>
                                    <tr>
                                        <td>herb</td>
                                        <td>/hɜːb/</td>
                                        <td>thảo mộc</td>
                                    </tr>
                                    <tr>
                                        <td>immune system</td>
                                        <td>/ɪˈmjuːn ˌsɪstəm/</td>
                                        <td>hệ miễn dịch</td>
                                    </tr>
                                    <tr>
                                        <td>blood circulation</td>
                                        <td>/blʌd ˌsɜːkjuˈleɪʃn/</td>
                                        <td>tuần hoàn máu</td>
                                    </tr>
                                    <tr>
                                        <td>elasticity</td>
                                        <td>/ˌiːlæˈstɪsəti/</td>
                                        <td>độ đàn hồi</td>
                                    </tr>
                                    <tr>
                                        <td>anti-inflammatory</td>
                                        <td>/ˌænti ɪnˈflæmətəri/</td>
                                        <td>chống viêm</td>
                                    </tr>
                                    <tr>
                                        <td>detoxifying</td>
                                        <td>/diːˈtɒksɪfaɪɪŋ/</td>
                                        <td>giải độc</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Vocabulary Game -->
                    <div class="vocabulary-game mb-5">
                        <h3 class="section-title mb-4">Vocabulary Game</h3>
                        <div class="card">
                            <div class="card-body">
                                <div id="game-container">
                                    <div class="game-section mb-4">
                                        <h5 class="mb-3">Match the words with their meanings</h5>
                                        <div class="row g-3" id="matching-game">
                                            <!-- Words will be dynamically added here by JavaScript -->
                                        </div>
                                    </div>

                                    <div class="game-controls text-center">
                                        <button class="btn btn-secondary" id="reset-game">Reset Game</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="col-lg-4">
                    <div class="card sidebar-card sticky-top" style="top: 2rem;">
                        <div class="card-body">
                            <h5 class="section-title mb-4">Related Articles</h5>
                            <div class="related-articles">
                                <!-- Related articles will be dynamically added here -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Styles -->
    <style>
        .article-content {
            font-size: 1.1rem;
            line-height: 1.8;
        }

        .content-section {
            background: #fff;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .audio-player {
            background: #f8f9fa;
            padding: 1rem;
            border-radius: 8px;
        }

        .audio-player audio {
            width: 100%;
        }

        .word-bank {
            background: #fff;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .vocabulary-game .card {
            border: none;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .word-card {
            border: 2px solid #e9ecef;
            border-radius: 8px;
            padding: 1rem;
            cursor: pointer;
            transition: all 0.3s ease;
            background: white;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
        }

        .word-card.selected {
            border-color: #007bff;
            background-color: #f8f9fa;
        }

        .word-card.correct {
            border-color: #28a745;
            background-color: #d4edda;
            cursor: not-allowed;
            opacity: 0.8;
        }

        .word-card.incorrect {
            border-color: #dc3545;
            background-color: #f8d7da;
            transition: all 0.3s ease;
        }

        .word-card.matched {
            cursor: not-allowed;
            opacity: 0.7;
        }

        .game-controls {
            margin-top: 2rem;
        }

        .game-controls .btn {
            margin: 0 0.5rem;
        }

        .section-title {
            position: relative;
            padding-bottom: 0.5rem;
            margin-bottom: 1.5rem;
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 50px;
            height: 3px;
            background-color: #007bff;
        }

        .english-text {
            font-size: 1.1rem;
            line-height: 1.8;
            margin-bottom: 0.5rem;
        }

        .vietnamese-text {
            font-size: 1rem;
            line-height: 1.6;
            padding-left: 1rem;
            border-left: 3px solid #007bff;
            padding-left: 1rem;
            margin-top: 1rem;
            transition: opacity 0.3s ease;
        }

        .english-text strong {
            color: #007bff;
            font-weight: 600;
        }

        .toggle-translation {
            font-size: 0.9rem;
        }

        .toggle-translation.active {
            background-color: #007bff;
            color: white;
        }

        /* Add styles for text highlighting */
        ::selection {
            background-color: #fff9c4; /* Light yellow background */
            color: inherit;
        }

        ::-moz-selection {
            background-color: #fff9c4; /* Light yellow background */
            color: inherit;
        }

        .highlighted {
            background-color: #fff9c4;
        }
    </style>

    <!-- Scripts -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Handle text selection highlighting
            const articleContent = document.querySelector('.article-content');

            articleContent.addEventListener('mouseup', function() {
                const selection = window.getSelection();
                const selectedText = selection.toString().trim();

                if (selectedText) {
                    // Remove any existing highlights first
                    const range = selection.getRangeAt(0);
                    const span = document.createElement('span');
                    span.className = 'highlighted';

                    try {
                        range.surroundContents(span);
                    } catch (e) {
                        console.log('Could not highlight selection');
                    }
                }
            });

            // Handle toggle translation
            const toggleButtons = document.querySelectorAll('.toggle-translation');

            toggleButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const section = this.closest('.content-section');
                    const vietnameseText = section.querySelector('.vietnamese-text');
                    const toggleText = this.querySelector('.toggle-text');

                    // Toggle Vietnamese text visibility
                    vietnameseText.classList.toggle('d-none');

                    // Toggle button active state and text
                    this.classList.toggle('active');
                    toggleText.textContent = vietnameseText.classList.contains('d-none') ? 'Show Vietnamese' : 'Hide Vietnamese';
                });
            });
        });
    </script>

    <!-- Game Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const words = [
                { english: 'antioxidant', vietnamese: 'chất chống oxy hóa' },
                { english: 'beetroot', vietnamese: 'củ dền' },
                { english: 'elasticity', vietnamese: 'độ đàn hồi' },
                { english: 'herb', vietnamese: 'thảo mộc' },
                { english: 'radish', vietnamese: 'củ cải' },
                { english: 'detoxifying', vietnamese: 'giải độc' }
            ];

            const gameContainer = document.getElementById('matching-game');
            const resetButton = document.getElementById('reset-game');
            let selectedCard = null;

            function shuffleArray(array) {
                for (let i = array.length - 1; i > 0; i--) {
                    const j = Math.floor(Math.random() * (i + 1));
                    [array[i], array[j]] = [array[j], array[i]];
                }
                return array;
            }

            function createWordCard(text, type, pair) {
                const col = document.createElement('div');
                col.className = 'col-md-4 col-sm-6';

                const card = document.createElement('div');
                card.className = 'word-card';
                card.textContent = text;
                card.dataset.type = type;
                card.dataset.pair = pair;

                card.addEventListener('click', () => handleCardClick(card));

                col.appendChild(card);
                return col;
            }

            function handleCardClick(card) {
                // Ignore click if card is already correctly matched
                if (card.classList.contains('correct')) {
                    return;
                }

                // Remove any existing incorrect state
                document.querySelectorAll('.word-card').forEach(c => {
                    c.classList.remove('incorrect');
                });

                // If clicking the same card, deselect it
                if (selectedCard === card) {
                    card.classList.remove('selected');
                    selectedCard = null;
                    return;
                }

                // If no card is selected, select this one
                if (!selectedCard) {
                    card.classList.add('selected');
                    selectedCard = card;
                    return;
                }

                // Check for match
                const isMatch = selectedCard.dataset.pair === card.dataset.pair;

                if (isMatch) {
                    // Correct match - lock cards
                    selectedCard.classList.remove('selected');
                    selectedCard.classList.add('correct');
                    card.classList.add('correct');
                } else {
                    // Incorrect match - show red briefly
                    selectedCard.classList.remove('selected');
                    selectedCard.classList.add('incorrect');
                    card.classList.add('incorrect');

                    // Remove incorrect indication after a delay
                    setTimeout(() => {
                        selectedCard.classList.remove('incorrect');
                        card.classList.remove('incorrect');
                    }, 500); // Reduced to 500ms for quicker feedback
                }

                selectedCard = null;
            }

            function initializeGame() {
                gameContainer.innerHTML = '';
                selectedCard = null;

                // Create arrays for both English and Vietnamese words
                const englishCards = words.map((word, index) =>
                    createWordCard(word.english, 'english', index));
                const vietnameseCards = words.map((word, index) =>
                    createWordCard(word.vietnamese, 'vietnamese', index));

                // Combine and shuffle all cards
                const allCards = shuffleArray([...englishCards, ...vietnameseCards]);

                // Add cards to the game container
                allCards.forEach(card => gameContainer.appendChild(card));
            }

            // Initialize game
            initializeGame();

            // Reset game when clicking reset button
            resetButton.addEventListener('click', initializeGame);
        });
    </script>
@endsection
