<!-- Listening & Reading Test Section -->
<div class="test-section">
    <!-- Timer Section -->
    <div class="timer-section bg-white p-4 rounded-lg shadow-sm mb-4">
        <div class="d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center">
                <i class="fas fa-clock text-primary me-2"></i>
                <h6 class="m-0">Thời gian còn lại: <span id="countdown"
                        class="text-primary font-weight-bold">10:00</span></h6>
            </div>
            <div class="progress" style="width: 200px; height: 8px; background-color: #e9ecef; border-radius: 4px;">
                <div id="timer-progress" class="progress-bar bg-primary" role="progressbar"
                    style="width: 100%; border-radius: 4px;"></div>
            </div>
        </div>
    </div>

    <!-- Questions List -->
    <div class="questions-container">
        <!-- Question 1: Single Choice with Image -->
        <div class="question-card bg-white p-0 rounded-lg shadow-sm mb-4 overflow-hidden" data-question-id="1">
            <div class="question-header bg-primary text-white p-3">
                <div class="d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center">
                        <div class="question-number-circle me-3 bg-white text-primary d-flex align-items-center justify-content-center"
                            style="width: 35px; height: 35px; border-radius: 50%; font-weight: bold;">
                            1
                        </div>
                        <div class="d-flex align-items-center">
                            <span class="me-2">Câu 1:</span>
                            <h6 class="m-0">Single Choice Question</h6>
                        </div>
                    </div>
                    <div class="question-type-badge bg-white text-primary px-3 py-1 rounded-pill">
                        <small><i class="fas fa-tasks me-1"></i>Single Choice</small>
                    </div>
                </div>
            </div>

            <div class="question-content p-4">
                <div class="media-content mb-4">
                    <img src="https://via.placeholder.com/600x400" alt="Question Image"
                        class="img-fluid rounded shadow-sm">
                </div>

                <div class="question-text mb-4">
                    <h6 class="font-weight-bold text-dark">Look at the picture and choose the correct answer: What is
                        the main activity shown in the image?</h6>
                </div>

                <div class="answer-section">
                    <div class="single-choice">
                        <div class="custom-control custom-radio hover-effect mb-3">
                            <input type="radio" id="q1_option1" name="question1" class="custom-control-input"
                                value="1">
                            <label class="custom-control-label py-2 px-3 rounded w-100" for="q1_option1">
                                <span class="option-letter">A.</span> A group of students studying in a library
                            </label>
                        </div>
                        <div class="custom-control custom-radio hover-effect mb-3">
                            <input type="radio" id="q1_option2" name="question1" class="custom-control-input"
                                value="2">
                            <label class="custom-control-label py-2 px-3 rounded w-100" for="q1_option2">
                                <span class="option-letter">B.</span> People having a business meeting
                            </label>
                        </div>
                        <div class="custom-control custom-radio hover-effect mb-3">
                            <input type="radio" id="q1_option3" name="question1" class="custom-control-input"
                                value="3">
                            <label class="custom-control-label py-2 px-3 rounded w-100" for="q1_option3">
                                <span class="option-letter">C.</span> Children playing in a park
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Question 2: Multiple Choice with Audio -->
        <div class="question-card bg-white p-0 rounded-lg shadow-sm mb-4 overflow-hidden" data-question-id="2">
            <div class="question-header bg-primary text-white p-3">
                <div class="d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center">
                        <div class="question-number-circle me-3 bg-white text-primary d-flex align-items-center justify-content-center"
                            style="width: 35px; height: 35px; border-radius: 50%; font-weight: bold;">
                            2
                        </div>
                        <div class="d-flex align-items-center">
                            <span class="me-2">Câu 2:</span>
                            <h6 class="m-0">Multiple Choice Question</h6>
                        </div>
                    </div>
                    <div class="question-type-badge bg-white text-primary px-3 py-1 rounded-pill">
                        <small><i class="fas fa-tasks me-1"></i>Multiple Choice</small>
                    </div>
                </div>
            </div>

            <div class="question-content p-4">
                <div class="media-content mb-4">
                    <div class="audio-player bg-light p-3 rounded">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-headphones text-primary me-3"></i>
                            <audio controls class="flex-grow-1">
                                <source src="https://www.soundhelix.com/examples/mp3/SoundHelix-Song-1.mp3"
                                    type="audio/mpeg">
                                Your browser does not support the audio element.
                            </audio>
                        </div>
                    </div>
                </div>

                <div class="question-text mb-4">
                    <h6 class="font-weight-bold text-dark">Listen to the audio and select ALL the topics mentioned in
                        the conversation:</h6>
                </div>

                <div class="answer-section">
                    <div class="multiple-choice">
                        <div class="custom-control custom-checkbox hover-effect mb-3">
                            <input type="checkbox" id="q2_option1" name="question2[]" class="custom-control-input"
                                value="1">
                            <label class="custom-control-label py-2 px-3 rounded w-100" for="q2_option1">
                                <span class="option-letter">A.</span> Weather forecast
                            </label>
                        </div>
                        <div class="custom-control custom-checkbox hover-effect mb-3">
                            <input type="checkbox" id="q2_option2" name="question2[]" class="custom-control-input"
                                value="2">
                            <label class="custom-control-label py-2 px-3 rounded w-100" for="q2_option2">
                                <span class="option-letter">B.</span> Weekend plans
                            </label>
                        </div>
                        <div class="custom-control custom-checkbox hover-effect mb-3">
                            <input type="checkbox" id="q2_option3" name="question2[]" class="custom-control-input"
                                value="3">
                            <label class="custom-control-label py-2 px-3 rounded w-100" for="q2_option3">
                                <span class="option-letter">C.</span> Family dinner
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Question 3: Fill in the blank with Video -->
        <div class="question-card bg-white p-0 rounded-lg shadow-sm mb-4 overflow-hidden" data-question-id="3">
            <div class="question-header bg-primary text-white p-3">
                <div class="d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center">
                        <div class="question-number-circle me-3 bg-white text-primary d-flex align-items-center justify-content-center"
                            style="width: 35px; height: 35px; border-radius: 50%; font-weight: bold;">
                            3
                        </div>
                        <div class="d-flex align-items-center">
                            <span class="me-2">Câu 3:</span>
                            <h6 class="m-0">Fill in the Blank Question</h6>
                        </div>
                    </div>
                    <div class="question-type-badge bg-white text-primary px-3 py-1 rounded-pill">
                        <small><i class="fas fa-tasks me-1"></i>Fill in the Blank</small>
                    </div>
                </div>
            </div>

            <div class="question-content p-4">
                <div class="media-content mb-4">
                    <div class="video-player rounded overflow-hidden shadow-sm">
                        <video controls class="w-100">
                            <source src="https://www.w3schools.com/html/mov_bbb.mp4" type="video/mp4">
                            Your browser does not support the video element.
                        </video>
                    </div>
                </div>

                <div class="question-text mb-4">
                    <h6 class="font-weight-bold text-dark">Watch the video and complete the sentence:</h6>
                    <p class="mt-3 text-muted">The main character in the video is trying to _________.</p>
                </div>

                <div class="answer-section">
                    <div class="fill-blank">
                        <input type="text" class="form-control form-control-lg" name="question3"
                            placeholder="Type your answer here">
                    </div>
                </div>
            </div>
        </div>

        <!-- Question 4: Reading Comprehension -->
        <div class="question-card bg-white p-0 rounded-lg shadow-sm mb-4 overflow-hidden" data-question-id="4">
            <div class="question-header bg-primary text-white p-3">
                <div class="d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center">
                        <div class="question-number-circle me-3 bg-white text-primary d-flex align-items-center justify-content-center"
                            style="width: 35px; height: 35px; border-radius: 50%; font-weight: bold;">
                            4
                        </div>
                        <div class="d-flex align-items-center">
                            <span class="me-2">Câu 4:</span>
                            <h6 class="m-0">Reading Comprehension</h6>
                        </div>
                    </div>
                    <div class="question-type-badge bg-white text-primary px-3 py-1 rounded-pill">
                        <small><i class="fas fa-tasks me-1"></i>Reading Comprehension</small>
                    </div>
                </div>
            </div>

            <div class="question-content p-4">
                <div class="question-text mb-4">
                    <h6 class="font-weight-bold text-dark mb-3">Read the passage and answer the question:</h6>
                    <div class="reading-passage p-4 bg-light rounded mb-4" style="border-left: 4px solid #0d6efd;">
                        <p class="mb-0">The Industrial Revolution was a period of major industrialization and
                            innovation during the late 18th and early 19th century. The Industrial Revolution began in
                            Great Britain and quickly spread throughout Europe and the United States. This era changed
                            the way people worked, lived, and thought about society.</p>
                    </div>
                    <p class="mt-3 text-dark">According to the passage, where did the Industrial Revolution begin?</p>
                </div>

                <div class="answer-section">
                    <div class="single-choice">
                        <div class="custom-control custom-radio hover-effect mb-3">
                            <input type="radio" id="q4_option1" name="question4" class="custom-control-input"
                                value="1">
                            <label class="custom-control-label py-2 px-3 rounded w-100" for="q4_option1">
                                <span class="option-letter">A.</span> United States
                            </label>
                        </div>
                        <div class="custom-control custom-radio hover-effect mb-3">
                            <input type="radio" id="q4_option2" name="question4" class="custom-control-input"
                                value="2">
                            <label class="custom-control-label py-2 px-3 rounded w-100" for="q4_option2">
                                <span class="option-letter">B.</span> Great Britain
                            </label>
                        </div>
                        <div class="custom-control custom-radio hover-effect mb-3">
                            <input type="radio" id="q4_option3" name="question4" class="custom-control-input"
                                value="3">
                            <label class="custom-control-label py-2 px-3 rounded w-100" for="q4_option3">
                                <span class="option-letter">C.</span> Europe
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Question 5: Image Word Matching -->
        <div class="question-card bg-white p-0 rounded-lg shadow-sm mb-4 overflow-hidden" data-question-id="5">
            <div class="question-header bg-primary text-white p-3">
                <div class="d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center">
                        <div class="question-number-circle me-3 bg-white text-primary d-flex align-items-center justify-content-center"
                            style="width: 35px; height: 35px; border-radius: 50%; font-weight: bold;">
                            5
                        </div>
                        <div class="d-flex align-items-center">
                            <span class="me-2">Câu 5:</span>
                            <h6 class="m-0">Từ vựng qua hình ảnh</h6>
                        </div>
                    </div>
                    <div class="question-type-badge bg-white text-primary px-3 py-1 rounded-pill">
                        <small><i class="fas fa-image me-1"></i>Image Matching</small>
                    </div>
                </div>
            </div>

            <div class="question-content p-4">
                <div class="image-display-section mb-4">
                    <div class="current-image-container text-center">
                        <img id="currentImage" src="" alt="Current Image"
                            class="img-fluid rounded shadow-sm" style="max-height: 400px;">
                    </div>
                </div>

                <div class="word-options-section">
                    <div class="d-flex flex-wrap justify-content-center gap-3" id="wordOptions">
                        <!-- Word options will be dynamically added here -->
                    </div>
                </div>
            </div>
        </div>

        <!-- Question 6: Daily Activities Drag & Drop -->
        <div class="question-card bg-white p-0 rounded-lg shadow-sm mb-4 overflow-hidden" data-question-id="6">
            <div class="question-header bg-primary text-white p-3">
                <div class="d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center">
                        <div class="question-number-circle me-3 bg-white text-primary d-flex align-items-center justify-content-center"
                            style="width: 35px; height: 35px; border-radius: 50%; font-weight: bold;">
                            6
                        </div>
                        <div class="d-flex align-items-center">
                            <span class="me-2">Câu 6:</span>
                            <h6 class="m-0">Hoạt động hàng ngày</h6>
                        </div>
                    </div>
                    <div class="question-type-badge bg-white text-primary px-3 py-1 rounded-pill">
                        <small><i class="fas fa-arrows-alt me-1"></i>Drag & Drop</small>
                    </div>
                </div>
            </div>

            <div class="question-content p-4">
                <div class="drag-drop-container">
                    <!-- Images Container -->
                    <div class="images-grid mb-4" id="imagesContainer">
                        <div class="draggable-image" draggable="true" data-activity="have lunch">
                            <img src="/images/activities/have-lunch.jpg" alt="Have Lunch">
                        </div>
                        <div class="draggable-image" draggable="true" data-activity="read a book">
                            <img src="/images/activities/read-book.jpg" alt="Read a Book">
                        </div>
                        <div class="draggable-image" draggable="true" data-activity="play video games">
                            <img src="/images/activities/play-games.jpg" alt="Play Video Games">
                        </div>
                        <div class="draggable-image" draggable="true" data-activity="have a shower">
                            <img src="/images/activities/shower.jpg" alt="Have a Shower">
                        </div>
                        <div class="draggable-image" draggable="true" data-activity="listen to music">
                            <img src="/images/activities/listen-music.jpg" alt="Listen to Music">
                        </div>
                        <div class="draggable-image" draggable="true" data-activity="go to bed">
                            <img src="/images/activities/go-to-bed.jpg" alt="Go to Bed">
                        </div>
                        <div class="draggable-image" draggable="true" data-activity="get up">
                            <img src="/images/activities/get-up.jpg" alt="Get Up">
                        </div>
                        <div class="draggable-image" draggable="true" data-activity="watch TV">
                            <img src="/images/activities/watch-tv.jpg" alt="Watch TV">
                        </div>
                        <div class="draggable-image" draggable="true" data-activity="get dressed">
                            <img src="/images/activities/get-dressed.jpg" alt="Get Dressed">
                        </div>
                        <div class="draggable-image" draggable="true" data-activity="have dinner">
                            <img src="/images/activities/have-dinner.jpg" alt="Have Dinner">
                        </div>
                    </div>

                    <!-- Drop Zones Container -->
                    <div class="drop-zones-grid" id="dropZonesContainer">
                        <div class="drop-zone" data-activity="have lunch">
                            <span class="activity-label">have lunch</span>
                        </div>
                        <div class="drop-zone" data-activity="read a book">
                            <span class="activity-label">read a book</span>
                        </div>
                        <div class="drop-zone" data-activity="play video games">
                            <span class="activity-label">play video games</span>
                        </div>
                        <div class="drop-zone" data-activity="have a shower">
                            <span class="activity-label">have a shower</span>
                        </div>
                        <div class="drop-zone" data-activity="listen to music">
                            <span class="activity-label">listen to music</span>
                        </div>
                        <div class="drop-zone" data-activity="go to bed">
                            <span class="activity-label">go to bed</span>
                        </div>
                        <div class="drop-zone" data-activity="get up">
                            <span class="activity-label">get up</span>
                        </div>
                        <div class="drop-zone" data-activity="watch TV">
                            <span class="activity-label">watch TV</span>
                        </div>
                        <div class="drop-zone" data-activity="get dressed">
                            <span class="activity-label">get dressed</span>
                        </div>
                        <div class="drop-zone" data-activity="have dinner">
                            <span class="activity-label">have dinner</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Question 7: Memory Matching Game -->
        <div class="question-card bg-white p-0 rounded-lg shadow-sm mb-4 overflow-hidden" data-question-id="7">
            <div class="question-header bg-primary text-white p-3">
                <div class="d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center">
                        <div class="question-number-circle me-3 bg-white text-primary d-flex align-items-center justify-content-center"
                            style="width: 35px; height: 35px; border-radius: 50%; font-weight: bold;">
                            7
                        </div>
                        <div class="d-flex align-items-center">
                            <span class="me-2">Câu 7:</span>
                            <h6 class="m-0">Ghép cặp từ vựng</h6>
                        </div>
                    </div>
                    <div class="d-flex align-items-center">
                        <div class="timer me-3">
                            <i class="fas fa-clock me-2"></i>
                            <span id="memoryGameTimer">0:00</span>
                        </div>
                        <div class="question-type-badge bg-white text-primary px-3 py-1 rounded-pill">
                            <small><i class="fas fa-gamepad me-1"></i>Memory Game</small>
                        </div>
                    </div>
                </div>
            </div>

            <div class="question-content p-4">
                <div class="memory-game-container">
                    <div class="game-stats mb-4 d-flex justify-content-between align-items-center">
                        <div class="moves">
                            <i class="fas fa-sync-alt me-2"></i>Số lần lật: <span id="moveCount">0</span>
                        </div>
                        <div class="matches">
                            <i class="fas fa-check-circle me-2"></i>Cặp đã ghép: <span id="matchCount">0</span>/10
                        </div>
                    </div>
                    <div class="memory-grid" id="memoryGrid">
                        <!-- Cards will be dynamically added here -->
                    </div>
                </div>
            </div>
        </div>

        <!-- Question 8: Fruit Slicing Game -->
        <div class="question-card bg-white p-0 rounded-lg shadow-sm mb-4 overflow-hidden" data-question-id="8">
            <div class="question-header bg-primary text-white p-3">
                <div class="d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center">
                        <div class="question-number-circle me-3 bg-white text-primary d-flex align-items-center justify-content-center"
                            style="width: 35px; height: 35px; border-radius: 50%; font-weight: bold;">
                            8
                        </div>
                        <div class="d-flex align-items-center">
                            <span class="me-2">Câu 8:</span>
                            <h6 class="m-0">Chém hoa quả</h6>
                        </div>
                    </div>
                    <div class="d-flex align-items-center">
                        <div class="score me-3">
                            <i class="fas fa-star me-2"></i>
                            <span id="fruitScore">0</span> điểm
                        </div>
                        <div class="question-type-badge bg-white text-primary px-3 py-1 rounded-pill">
                            <small><i class="fas fa-cut me-1"></i>Fruit Ninja</small>
                        </div>
                    </div>
                </div>
            </div>

            <div class="question-content p-4">
                <div class="fruit-game-container">
                    <!-- Question Display -->
                    <div class="question-display mb-4 p-3 bg-light rounded">
                        <h5 class="text-center" id="fruitQuestion">What is the past tense of "go"?</h5>
                    </div>

                    <!-- Game Canvas -->
                    <div class="game-area position-relative">
                        <canvas id="fruitCanvas" class="rounded shadow"></canvas>
                        <div id="startGame" class="start-overlay">
                            <button class="btn btn-primary btn-lg">
                                <i class="fas fa-play me-2"></i>Bắt đầu
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Question 9: Image Categorization Game -->
        <div class="question-card bg-white p-0 rounded-lg shadow-sm mb-4 overflow-hidden" data-question-id="9">
            <div class="question-header bg-primary text-white p-3">
                <div class="d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center">
                        <div class="question-number-circle me-3 bg-white text-primary d-flex align-items-center justify-content-center"
                            style="width: 35px; height: 35px; border-radius: 50%; font-weight: bold;">
                            9
                        </div>
                        <div class="d-flex align-items-center">
                            <span class="me-2">Câu 9:</span>
                            <h6 class="m-0">Phân loại hình ảnh</h6>
                        </div>
                    </div>
                    <div class="d-flex align-items-center">
                        <div class="score me-3">
                            <i class="fas fa-star me-2"></i>
                            <span id="categorizationScore">0</span> điểm
                        </div>
                        <div class="question-type-badge bg-white text-primary px-3 py-1 rounded-pill">
                            <small><i class="fas fa-th-large me-1"></i>Categorization</small>
                        </div>
                    </div>
                </div>
            </div>

            <div class="question-content p-4">
                <div class="categorization-game">
                    <!-- Instructions -->
                    <div class="instructions mb-4 p-3 bg-light rounded">
                        <h6 class="mb-2"><i class="fas fa-info-circle me-2"></i>Hướng dẫn:</h6>
                        <p class="mb-0">Kéo và thả các hình ảnh vào đúng cột phân loại tương ứng.</p>
                    </div>

                    <div class="game-container">
                        <!-- Source Images Container -->
                        <div class="source-images mb-4 p-3 border rounded" id="sourceImages">
                            <h6 class="mb-3">Hình ảnh cần phân loại:</h6>
                            <div class="images-grid" id="imagesList">
                                <!-- Images will be dynamically added here -->
                            </div>
                        </div>

                        <!-- Category Columns -->
                        <div class="category-columns">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="category-column" data-category="food">
                                        <div class="category-header bg-primary text-white p-2 rounded-top">
                                            <h6 class="m-0">FOOD</h6>
                                        </div>
                                        <div class="category-items" id="foodCategory">
                                            <!-- Dropped food items will appear here -->
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="category-column" data-category="school-supplies">
                                        <div class="category-header bg-success text-white p-2 rounded-top">
                                            <h6 class="m-0">SCHOOL SUPPLIES</h6>
                                        </div>
                                        <div class="category-items" id="suppliesCategory">
                                            <!-- Dropped school supply items will appear here -->
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="category-column" data-category="toys">
                                        <div class="category-header bg-warning text-white p-2 rounded-top">
                                            <h6 class="m-0">TOYS</h6>
                                        </div>
                                        <div class="category-items" id="toysCategory">
                                            <!-- Dropped toy items will appear here -->
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="category-column" data-category="body-parts">
                                        <div class="category-header bg-info text-white p-2 rounded-top">
                                            <h6 class="m-0">PARTS OF BODY</h6>
                                        </div>
                                        <div class="category-items" id="bodyCategory">
                                            <!-- Dropped body part items will appear here -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Question 10: Word Search Game -->
        <div class="question-card bg-white p-0 rounded-lg shadow-sm mb-4 overflow-hidden" data-question-id="10">
            <div class="question-header bg-primary text-white p-3">
                <div class="d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center">
                        <div class="question-number-circle me-3 bg-white text-primary d-flex align-items-center justify-content-center"
                            style="width: 35px; height: 35px; border-radius: 50%; font-weight: bold;">
                            10
                        </div>
                        <div class="d-flex align-items-center">
                            <span class="me-2">Câu 10:</span>
                            <h6 class="m-0">Tìm từ trong bảng</h6>
                        </div>
                    </div>
                    <div class="d-flex align-items-center">
                        <div class="score me-3">
                            <i class="fas fa-star me-2"></i>
                            <span id="wordSearchScore">0</span> điểm
                        </div>
                        <div class="question-type-badge bg-white text-primary px-3 py-1 rounded-pill">
                            <small><i class="fas fa-search me-1"></i>Word Search</small>
                        </div>
                    </div>
                </div>
            </div>

            <div class="question-content p-4">
                <div class="word-search-game">
                    <!-- Instructions -->
                    <div class="instructions mb-4 p-3 bg-light rounded">
                        <h6 class="mb-2"><i class="fas fa-info-circle me-2"></i>Hướng dẫn:</h6>
                        <p class="mb-0">Tìm và khoanh tròn các từ được liệt kê. Các từ có thể nằm ngang, dọc hoặc
                            chéo.</p>
                    </div>

                    <div class="row">
                        <!-- Word Search Grid -->
                        <div class="col-md-8">
                            <div class="word-search-grid" id="wordSearchGrid">
                                <!-- Grid will be dynamically generated -->
                            </div>
                        </div>

                        <!-- Word List -->
                        <div class="col-md-4">
                            <div class="word-list-container">
                                <h6 class="mb-3">Các từ cần tìm:</h6>
                                <div class="word-list" id="wordList">
                                    <!-- Word list will be dynamically generated -->
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Controls -->
                    <div class="controls mt-4 text-center">
                        <button class="btn btn-primary me-2" id="checkWords">
                            <i class="fas fa-check me-2"></i>Kiểm tra
                        </button>
                        <button class="btn btn-outline-primary" id="resetGame">
                            <i class="fas fa-redo me-2"></i>Chơi lại
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Navigation Buttons -->
    <div
        class="test-navigation d-flex justify-content-between align-items-center mt-4 bg-white p-3 rounded-lg shadow-sm">
        <button class="btn btn-outline-primary px-4" id="prevQuestion">
            <i class="fas fa-chevron-left me-2"></i>Câu hỏi trước
        </button>
        <div class="question-indicators">
            <div class="btn-group" role="group">
                <button type="button" class="btn btn-outline-primary active" style="min-width: 45px;">1</button>
                <button type="button" class="btn btn-outline-primary" style="min-width: 45px;">2</button>
                <button type="button" class="btn btn-outline-primary" style="min-width: 45px;">3</button>
                <button type="button" class="btn btn-outline-primary" style="min-width: 45px;">4</button>
                <button type="button" class="btn btn-outline-primary" style="min-width: 45px;">5</button>
                <button type="button" class="btn btn-outline-primary" style="min-width: 45px;">6</button>
                <button type="button" class="btn btn-outline-primary" style="min-width: 45px;">7</button>
                <button type="button" class="btn btn-outline-primary" style="min-width: 45px;">8</button>
                <button type="button" class="btn btn-outline-primary" style="min-width: 45px;">9</button>
                <button type="button" class="btn btn-outline-primary" style="min-width: 45px;">10</button>
            </div>
        </div>
        <button class="btn btn-outline-primary px-4" id="nextQuestion">
            Câu hỏi tiếp theo<i class="fas fa-chevron-right ms-2"></i>
        </button>
    </div>

    <!-- Submit Button -->
    <div class="text-center mt-4">
        <button class="btn btn-primary btn-lg px-5" id="submitTest">
            <i class="fas fa-paper-plane me-2"></i>Nộp bài
        </button>
    </div>
</div>

@push('styles')
    <style>
        .question-card {
            transition: all 0.3s ease;
        }

        .question-header {
            background: linear-gradient(90deg, #0d6efd, #0dcaf0);
        }

        .hover-effect {
            transition: all 0.2s ease;
        }

        .hover-effect:hover {
            transform: translateX(5px);
        }

        .custom-control-label {
            cursor: pointer;
            border: 1px solid #dee2e6;
            transition: all 0.2s ease;
        }

        .custom-control-input:checked~.custom-control-label {
            background-color: #e7f1ff;
            border-color: #0d6efd;
        }

        .custom-control-label:hover {
            background-color: #f8f9fa;
        }

        .option-letter {
            font-weight: bold;
            color: #0d6efd;
            margin-right: 10px;
        }

        .btn-outline-primary {
            border-width: 2px;
        }

        .btn-outline-primary:hover {
            transform: translateY(-1px);
        }

        .progress {
            overflow: hidden;
            box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.1);
        }

        .progress-bar {
            transition: width 1s linear;
        }

        .audio-player audio {
            height: 40px;
        }

        .audio-player audio::-webkit-media-controls-panel {
            background-color: white;
        }

        .reading-passage {
            line-height: 1.8;
            color: #495057;
        }

        .form-control-lg {
            border: 2px solid #dee2e6;
            transition: all 0.2s ease;
        }

        .form-control-lg:focus {
            border-color: #0d6efd;
            box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.15);
        }

        .btn-group .btn {
            border-width: 2px;
            font-weight: 500;
        }

        .btn-group .btn.active {
            background-color: #0d6efd;
            color: white;
        }

        /* Animation for question transitions */
        .question-card {
            animation: slideIn 0.3s ease;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateX(20px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .question-type-badge {
            font-weight: 500;
            font-size: 0.875rem;
        }

        .question-number-circle {
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            font-size: 1.1rem;
        }

        /* Styles for Image Word Matching */
        .word-option {
            padding: 10px 20px;
            border: 2px solid #0d6efd;
            border-radius: 25px;
            cursor: pointer;
            transition: all 0.3s ease;
            background: white;
            font-size: 1.2rem;
            font-weight: 500;
            min-width: 120px;
            text-align: center;
        }

        .word-option:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(13, 110, 253, 0.2);
        }

        .word-option.correct {
            background: #198754;
            color: white;
            border-color: #198754;
        }

        .word-option.incorrect {
            animation: shake 0.5s;
        }

        .word-option.disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        @keyframes shake {

            0%,
            100% {
                transform: translateX(0);
            }

            10%,
            30%,
            50%,
            70%,
            90% {
                transform: translateX(-5px);
            }

            20%,
            40%,
            60%,
            80% {
                transform: translateX(5px);
            }
        }

        .gap-3 {
            gap: 1rem !important;
        }

        /* Styles for Drag & Drop Activity */
        .drag-drop-container {
            padding: 20px;
        }

        .images-grid {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 15px;
            margin-bottom: 30px;
        }

        .draggable-image {
            border: 2px solid #dee2e6;
            border-radius: 8px;
            overflow: hidden;
            cursor: move;
            transition: all 0.3s ease;
            position: relative;
        }

        .draggable-image:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .draggable-image img {
            width: 100%;
            height: 120px;
            object-fit: cover;
        }

        .drop-zones-grid {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 15px;
        }

        .drop-zone {
            border: 2px dashed #0d6efd;
            border-radius: 8px;
            height: 120px;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 10px;
            transition: all 0.3s ease;
            background: #f8f9fa;
        }

        .drop-zone.dragover {
            background: #e7f1ff;
            border-style: solid;
        }

        .drop-zone.correct {
            border-color: #198754;
            background: #d1e7dd;
        }

        .drop-zone.incorrect {
            border-color: #dc3545;
            background: #f8d7da;
            animation: shake 0.5s;
        }

        .activity-label {
            text-align: center;
            font-weight: 500;
            color: #6c757d;
        }

        .draggable-image.dragging {
            opacity: 0.5;
        }

        @keyframes shake {

            0%,
            100% {
                transform: translateX(0);
            }

            10%,
            30%,
            50%,
            70%,
            90% {
                transform: translateX(-5px);
            }

            20%,
            40%,
            60%,
            80% {
                transform: translateX(5px);
            }
        }

        /* Styles for Memory Matching Game */
        .memory-game-container {
            padding: 20px;
        }

        .memory-grid {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            gap: 10px;
            margin-bottom: 20px;
        }

        .memory-card {
            aspect-ratio: 1;
            perspective: 1000px;
            cursor: pointer;
        }

        .memory-card-inner {
            position: relative;
            width: 100%;
            height: 100%;
            text-align: center;
            transition: transform 0.6s;
            transform-style: preserve-3d;
            cursor: pointer;
        }

        .memory-card.flipped .memory-card-inner {
            transform: rotateY(180deg);
        }

        .memory-card-front,
        .memory-card-back {
            position: absolute;
            width: 100%;
            height: 100%;
            backface-visibility: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2em;
            font-weight: bold;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .memory-card-front {
            background: linear-gradient(135deg, #0d6efd, #0dcaf0);
            color: white;
        }

        .memory-card-back {
            background: white;
            transform: rotateY(180deg);
            border: 2px solid #0d6efd;
        }

        .memory-card-back img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 6px;
        }

        .memory-card-back .word {
            font-size: 1rem;
            padding: 10px;
            color: #0d6efd;
        }

        .memory-card.matched .memory-card-inner {
            transform: rotateY(180deg);
            box-shadow: 0 0 15px rgba(25, 135, 84, 0.5);
        }

        .memory-card.matched .memory-card-back {
            border-color: #198754;
        }

        .memory-card.wrong {
            animation: shake 0.5s;
        }

        .game-stats {
            font-size: 1.1rem;
            color: #6c757d;
        }

        @keyframes shake {

            0%,
            100% {
                transform: translateX(0);
            }

            10%,
            30%,
            50%,
            70%,
            90% {
                transform: translateX(-5px);
            }

            20%,
            40%,
            60%,
            80% {
                transform: translateX(5px);
            }
        }

        /* Styles for Fruit Slicing Game */
        .fruit-game-container {
            padding: 20px;
        }

        .game-area {
            width: 100%;
            height: 500px;
            background: linear-gradient(180deg, #87CEEB, #1E90FF);
            border-radius: 12px;
            overflow: hidden;
            position: relative;
        }

        #fruitCanvas {
            width: 100%;
            height: 100%;
            cursor: crosshair;
        }

        .start-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(0, 0, 0, 0.5);
            border-radius: 12px;
        }

        .question-display {
            background: rgba(255, 255, 255, 0.95) !important;
            border-left: 5px solid #0d6efd;
        }

        /* Hiệu ứng khi chọn đáp án */
        .fruit-effect {
            position: absolute;
            width: 100px;
            height: 100px;
            pointer-events: none;
            z-index: 1000;
            transform: translate(-50%, -50%);
            animation: effectFadeOut 0.5s ease-out forwards;
        }

        /* Hiệu ứng rung màn hình */
        @keyframes shake {

            0%,
            100% {
                transform: translateX(0);
            }

            10%,
            30%,
            50%,
            70%,
            90% {
                transform: translateX(-5px);
            }

            20%,
            40%,
            60%,
            80% {
                transform: translateX(5px);
            }
        }

        .fruit-effect.correct {
            background: url('/images/effects/correct.png') no-repeat center center;
            background-size: contain;
            animation: correctEffect 0.5s ease-out forwards;
        }

        .fruit-effect.wrong {
            background: url('/images/effects/wrong.png') no-repeat center center;
            background-size: contain;
            animation: wrongEffect 0.5s ease-out forwards;
        }

        @keyframes effectFadeOut {
            0% {
                opacity: 1;
                transform: translate(-50%, -50%) scale(0.5);
            }

            100% {
                opacity: 0;
                transform: translate(-50%, -50%) scale(1.5);
            }
        }

        @keyframes correctEffect {
            0% {
                opacity: 1;
                transform: translate(-50%, -50%) scale(0.5) rotate(0deg);
            }

            100% {
                opacity: 0;
                transform: translate(-50%, -50%) scale(1.5) rotate(360deg);
            }
        }

        @keyframes wrongEffect {
            0% {
                opacity: 1;
                transform: translate(-50%, -50%) scale(0.5);
            }

            25% {
                transform: translate(-50%, -50%) scale(1.2) rotate(-5deg);
            }

            50% {
                transform: translate(-50%, -50%) scale(1.2) rotate(5deg);
            }

            75% {
                transform: translate(-50%, -50%) scale(1.2) rotate(-5deg);
            }

            100% {
                opacity: 0;
                transform: translate(-50%, -50%) scale(0.5) rotate(0deg);
            }
        }

        /* Hiệu ứng điểm số */
        .score-popup {
            position: absolute;
            color: #fff;
            font-size: 24px;
            font-weight: bold;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
            pointer-events: none;
            z-index: 1000;
            animation: scorePopup 1s ease-out forwards;
        }

        @keyframes scorePopup {
            0% {
                opacity: 1;
                transform: translateY(0);
            }

            100% {
                opacity: 0;
                transform: translateY(-50px);
            }
        }

        /* Styles for Image Categorization Game */
        .categorization-game {
            min-height: 600px;
        }

        .source-images {
            background: #f8f9fa;
            border: 2px dashed #dee2e6;
            min-height: 150px;
        }

        .images-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(100px, 1fr));
            gap: 15px;
            padding: 10px;
        }

        .draggable-item {
            width: 100px;
            height: 100px;
            border: 2px solid #dee2e6;
            border-radius: 8px;
            cursor: move;
            background: white;
            transition: all 0.3s ease;
            position: relative;
            user-select: none;
        }

        .draggable-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 6px;
        }

        .draggable-item:hover {
            transform: scale(1.05);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .draggable-item.dragging {
            opacity: 0.5;
            transform: scale(1.05);
        }

        .category-column {
            border: 2px solid #dee2e6;
            border-radius: 8px;
            margin-bottom: 20px;
            min-height: 300px;
            background: white;
        }

        .category-header {
            text-align: center;
            font-weight: bold;
        }

        .category-items {
            min-height: 250px;
            padding: 15px;
            display: flex;
            flex-direction: column;
            gap: 10px;
            background: #f8f9fa;
        }

        .category-items.dragover {
            background: #e7f1ff;
            border: 2px dashed #0d6efd;
        }

        .dropped-item {
            width: 100%;
            height: 100px;
            border: 1px solid #dee2e6;
            border-radius: 8px;
            overflow: hidden;
            position: relative;
            background: white;
        }

        .dropped-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .dropped-item .remove-item {
            position: absolute;
            top: 5px;
            right: 5px;
            width: 24px;
            height: 24px;
            background: rgba(255, 255, 255, 0.9);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            color: #dc3545;
            border: none;
            padding: 0;
            font-size: 14px;
        }

        .dropped-item .remove-item:hover {
            background: #dc3545;
            color: white;
        }

        .category-feedback {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            padding: 10px 20px;
            border-radius: 20px;
            color: white;
            font-weight: bold;
            opacity: 0;
            transition: all 0.3s ease;
        }

        .category-feedback.correct {
            background: rgba(40, 167, 69, 0.9);
            animation: feedbackPopup 1s ease-out forwards;
        }

        .category-feedback.wrong {
            background: rgba(220, 53, 69, 0.9);
            animation: feedbackPopup 1s ease-out forwards;
        }

        @keyframes feedbackPopup {
            0% {
                opacity: 0;
                transform: translate(-50%, -50%) scale(0.8);
            }

            50% {
                opacity: 1;
                transform: translate(-50%, -50%) scale(1.1);
            }

            100% {
                opacity: 0;
                transform: translate(-50%, -50%) scale(1);
            }
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .images-grid {
                grid-template-columns: repeat(auto-fill, minmax(80px, 1fr));
            }

            .draggable-item {
                width: 80px;
                height: 80px;
            }
        }

        /* Styles for Word Search Game */
        .word-search-game {
            min-height: 600px;
        }

        .word-search-grid {
            display: grid;
            grid-template-columns: repeat(12, 1fr);
            gap: 2px;
            background: #f8f9fa;
            padding: 10px;
            border-radius: 8px;
            border: 2px solid #dee2e6;
        }

        .grid-cell {
            aspect-ratio: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            background: white;
            border: 1px solid #dee2e6;
            font-size: 1.25rem;
            font-weight: bold;
            cursor: pointer;
            user-select: none;
            transition: all 0.2s ease;
        }

        .grid-cell:hover {
            background: #e7f1ff;
        }

        .grid-cell.selected {
            background: #0d6efd;
            color: white;
        }

        .grid-cell.highlighted {
            background: #198754;
            color: white;
            animation: pulse 0.5s ease-in-out;
        }

        .word-list-container {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            border: 2px solid #dee2e6;
            height: 100%;
        }

        .word-list {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .word-item {
            padding: 8px 15px;
            background: white;
            border: 1px solid #dee2e6;
            border-radius: 20px;
            cursor: pointer;
            transition: all 0.2s ease;
            font-weight: 500;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .word-item:hover {
            background: #e7f1ff;
            transform: translateX(5px);
        }

        .word-item.found {
            background: #198754;
            color: white;
            border-color: #198754;
        }

        .word-item.found::after {
            content: '✓';
            margin-left: 10px;
        }

        .word-item.incorrect {
            animation: shake 0.5s ease-in-out;
            background: #dc3545;
            color: white;
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.1);
            }

            100% {
                transform: scale(1);
            }
        }

        @keyframes shake {

            0%,
            100% {
                transform: translateX(0);
            }

            25% {
                transform: translateX(-5px);
            }

            75% {
                transform: translateX(5px);
            }
        }

        .selection-line {
            position: absolute;
            background: rgba(13, 110, 253, 0.3);
            pointer-events: none;
            z-index: 1;
        }

        .controls {
            margin-top: 20px;
            display: flex;
            gap: 10px;
            justify-content: center;
        }

        /* Responsive styles */
        @media (max-width: 768px) {
            .word-search-grid {
                grid-template-columns: repeat(12, 1fr);
                gap: 1px;
            }

            .grid-cell {
                font-size: 1rem;
            }

            .word-list-container {
                margin-top: 20px;
            }
        }

        @media (max-width: 576px) {
            .grid-cell {
                font-size: 0.875rem;
            }
        }
    </style>
@endpush

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Timer functionality
            let timeLeft = 600; // 10 minutes in seconds
            const countdownElement = document.getElementById('countdown');
            const timerProgress = document.getElementById('timer-progress');

            const timer = setInterval(() => {
                timeLeft--;
                const minutes = Math.floor(timeLeft / 60);
                const seconds = timeLeft % 60;
                countdownElement.textContent =
                    `${String(minutes).padStart(2, '0')}:${String(seconds).padStart(2, '0')}`;

                const progressPercentage = (timeLeft / 600) * 100;
                timerProgress.style.width = `${progressPercentage}%`;

                if (timeLeft <= 0) {
                    clearInterval(timer);
                    submitTest();
                }
            }, 1000);

            // Question navigation
            const questions = document.querySelectorAll('.question-card');
            const indicators = document.querySelectorAll('.question-indicators button');
            let currentQuestion = 0;

            function showQuestion(index) {
                questions.forEach((q, i) => {
                    q.style.display = i === index ? 'block' : 'none';
                });
                indicators.forEach((ind, i) => {
                    ind.classList.toggle('active', i === index);
                });

                // Update navigation buttons
                document.getElementById('prevQuestion').disabled = index === 0;
                document.getElementById('nextQuestion').disabled = index === questions.length - 1;
            }

            // Initialize first question
            showQuestion(0);

            // Navigation button handlers
            document.getElementById('prevQuestion').addEventListener('click', () => {
                if (currentQuestion > 0) {
                    currentQuestion--;
                    showQuestion(currentQuestion);
                }
            });

            document.getElementById('nextQuestion').addEventListener('click', () => {
                if (currentQuestion < questions.length - 1) {
                    currentQuestion++;
                    showQuestion(currentQuestion);
                }
            });

            // Indicator button handlers
            indicators.forEach((button, index) => {
                button.addEventListener('click', () => {
                    currentQuestion = index;
                    showQuestion(currentQuestion);
                });
            });

            // Submit test function
            const submitTest = () => {
                const answers = {};
                questions.forEach(question => {
                    const questionId = question.dataset.questionId;
                    const inputs = question.querySelectorAll('input');

                    if (inputs[0].type === 'radio') {
                        const checked = question.querySelector('input:checked');
                        answers[questionId] = checked ? checked.value : null;
                    } else if (inputs[0].type === 'checkbox') {
                        answers[questionId] = Array.from(question.querySelectorAll('input:checked'))
                            .map(cb => cb.value);
                    } else {
                        answers[questionId] = inputs[0].value;
                    }
                });
            };

            document.getElementById('submitTest').addEventListener('click', submitTest);

            // Image Word Matching Game
            const imageWordGame = {
                images: [{
                        url: '/images/vocabulary/tree.jpg',
                        word: 'tree'
                    },
                    {
                        url: '/images/vocabulary/cat.jpg',
                        word: 'cat'
                    },
                    {
                        url: '/images/vocabulary/elephant.jpg',
                        word: 'elephant'
                    },
                    {
                        url: '/images/vocabulary/boat.jpg',
                        word: 'boat'
                    },
                    {
                        url: '/images/vocabulary/kite.jpg',
                        word: 'kite'
                    },
                    {
                        url: '/images/vocabulary/hat.jpg',
                        word: 'hat'
                    },
                    {
                        url: '/images/vocabulary/flower.jpg',
                        word: 'flower'
                    },
                    {
                        url: '/images/vocabulary/dog.jpg',
                        word: 'dog'
                    },
                    {
                        url: '/images/vocabulary/ice-cream.jpg',
                        word: 'ice-cream'
                    },
                    {
                        url: '/images/vocabulary/apple.jpg',
                        word: 'apple'
                    }
                ],
                currentImageIndex: 0,
                correctAnswers: new Set(),

                initialize() {
                    this.currentImage = document.getElementById('currentImage');
                    this.wordOptionsContainer = document.getElementById('wordOptions');
                    this.setupGame();
                },

                setupGame() {
                    // Create word options
                    this.images.forEach(item => {
                        const wordButton = document.createElement('button');
                        wordButton.className = 'word-option';
                        wordButton.textContent = item.word;
                        wordButton.addEventListener('click', () => this.checkAnswer(item.word,
                            wordButton));
                        this.wordOptionsContainer.appendChild(wordButton);
                    });

                    // Show first image
                    this.showCurrentImage();
                },

                showCurrentImage() {
                    if (this.currentImageIndex < this.images.length) {
                        this.currentImage.src = this.images[this.currentImageIndex].url;
                        this.currentImage.alt = `Image ${this.currentImageIndex + 1}`;
                    } else {
                        // Game completed
                        this.showCompletionMessage();
                    }
                },

                checkAnswer(selectedWord, button) {
                    const correctWord = this.images[this.currentImageIndex].word;

                    if (selectedWord === correctWord) {
                        // Correct answer
                        button.classList.add('correct');
                        this.correctAnswers.add(selectedWord);

                        // Remove the button with animation
                        setTimeout(() => {
                            button.style.opacity = '0';
                            setTimeout(() => button.remove(), 300);
                        }, 500);

                        // Move to next image
                        setTimeout(() => {
                            this.currentImageIndex++;
                            this.showCurrentImage();
                        }, 800);
                    } else {
                        // Incorrect answer
                        button.classList.add('incorrect');
                        setTimeout(() => button.classList.remove('incorrect'), 500);

                        // Move to next image after showing incorrect animation
                        setTimeout(() => {
                            this.currentImageIndex++;
                            this.showCurrentImage();
                        }, 800);
                    }
                },

                showCompletionMessage() {
                    const totalQuestions = this.images.length;
                    const correctCount = this.correctAnswers.size;
                    const percentage = (correctCount / totalQuestions) * 100;

                    let messageHTML = '';
                    if (percentage >= 80) {
                        // Thành công
                        messageHTML = `
                    <div class="alert alert-success mt-4">
                        <h4 class="alert-heading">Chúc mừng! 🎉</h4>
                        <p>Bạn đã hoàn thành xuất sắc bài tập. Số từ đúng: ${correctCount}/${totalQuestions} (${percentage}%)</p>
                    </div>
                `;
                        this.currentImage.src = '/images/vocabulary/completion-success.jpg';
                    } else {
                        // Thất bại
                        messageHTML = `
                    <div class="alert alert-danger mt-4">
                        <h4 class="alert-heading">Chưa đạt yêu cầu! 😢</h4>
                        <p>Bạn cần đạt ít nhất 80% số câu đúng để vượt qua. Số từ đúng: ${correctCount}/${totalQuestions} (${percentage}%)</p>
                        <hr>
                        <button class="btn btn-danger" onclick="window.location.reload()">
                            <i class="fas fa-redo me-2"></i>Làm lại bài tập
                        </button>
                </div>
                `;
                        this.currentImage.src = '/images/vocabulary/completion-fail.jpg';
                    }

                    // Xóa các từ còn lại
                    while (this.wordOptionsContainer.firstChild) {
                        this.wordOptionsContainer.firstChild.remove();
                    }

                    // Thêm thông báo
                    const messageElement = document.createElement('div');
                    messageElement.innerHTML = messageHTML;
                    this.wordOptionsContainer.parentNode.appendChild(messageElement);
                }
            };

            // Initialize Image Word Game
            imageWordGame.initialize();

            // Drag & Drop Activity
            const draggableImages = document.querySelectorAll('.draggable-image');
            const dropZones = document.querySelectorAll('.drop-zone');
            let correctMatches = 0;
            const totalActivities = draggableImages.length;

            draggableImages.forEach(image => {
                image.addEventListener('dragstart', function(e) {
                    e.dataTransfer.setData('text/plain', this.dataset.activity);
                    this.classList.add('dragging');
                });

                image.addEventListener('dragend', function() {
                    this.classList.remove('dragging');
                });
            });

            dropZones.forEach(zone => {
                zone.addEventListener('dragover', function(e) {
                    e.preventDefault();
                    this.classList.add('dragover');
                });

                zone.addEventListener('dragleave', function() {
                    this.classList.remove('dragover');
                });

                zone.addEventListener('drop', function(e) {
                    e.preventDefault();
                    this.classList.remove('dragover');

                    const draggedActivity = e.dataTransfer.getData('text/plain');
                    const correctActivity = this.dataset.activity;

                    if (draggedActivity === correctActivity) {
                        // Correct match
                        this.classList.add('correct');
                        const draggedImage = document.querySelector(
                            `[data-activity="${draggedActivity}"]`);
                        this.innerHTML = ''; // Clear the label
                        this.appendChild(draggedImage.querySelector('img').cloneNode(true));
                        draggedImage.style.display = 'none';
                        correctMatches++;

                        // Check if all matches are complete
                        if (correctMatches === totalActivities) {
                            showCompletionMessage();
                        }
                    } else {
                        // Incorrect match
                        this.classList.add('incorrect');
                        setTimeout(() => {
                            this.classList.remove('incorrect');
                        }, 1000);
                    }
                });
            });

            function showCompletionMessage() {
                const percentage = (correctMatches / totalActivities) * 100;
                const messageHTML = `
            <div class="alert alert-success mt-4">
                <h4 class="alert-heading">Chúc mừng! 🎉</h4>
                <p>Bạn đã hoàn thành bài tập kéo thả. Số hoạt động đúng: ${correctMatches}/${totalActivities}</p>
            </div>
        `;
                const messageElement = document.createElement('div');
                messageElement.innerHTML = messageHTML;
                document.querySelector('.drag-drop-container').appendChild(messageElement);
            }

            // Memory Matching Game
            class MemoryGame {
                constructor() {
                    this.cards = [{
                            id: 1,
                            type: 'image',
                            content: '/images/vocabulary/have-lunch.jpg',
                            pair: 'have lunch'
                        },
                        {
                            id: 2,
                            type: 'word',
                            content: 'have lunch',
                            pair: 'have-lunch.jpg'
                        },
                        {
                            id: 3,
                            type: 'image',
                            content: '/images/vocabulary/read-book.jpg',
                            pair: 'read a book'
                        },
                        {
                            id: 4,
                            type: 'word',
                            content: 'read a book',
                            pair: 'read-book.jpg'
                        },
                        {
                            id: 5,
                            type: 'image',
                            content: '/images/vocabulary/play-games.jpg',
                            pair: 'play video games'
                        },
                        {
                            id: 6,
                            type: 'word',
                            content: 'play video games',
                            pair: 'play-games.jpg'
                        },
                        {
                            id: 7,
                            type: 'image',
                            content: '/images/vocabulary/shower.jpg',
                            pair: 'have a shower'
                        },
                        {
                            id: 8,
                            type: 'word',
                            content: 'have a shower',
                            pair: 'shower.jpg'
                        },
                        {
                            id: 9,
                            type: 'image',
                            content: '/images/vocabulary/listen-music.jpg',
                            pair: 'listen to music'
                        },
                        {
                            id: 10,
                            type: 'word',
                            content: 'listen to music',
                            pair: 'listen-music.jpg'
                        },
                        {
                            id: 11,
                            type: 'image',
                            content: '/images/vocabulary/go-to-bed.jpg',
                            pair: 'go to bed'
                        },
                        {
                            id: 12,
                            type: 'word',
                            content: 'go to bed',
                            pair: 'go-to-bed.jpg'
                        },
                        {
                            id: 13,
                            type: 'image',
                            content: '/images/vocabulary/get-up.jpg',
                            pair: 'get up'
                        },
                        {
                            id: 14,
                            type: 'word',
                            content: 'get up',
                            pair: 'get-up.jpg'
                        },
                        {
                            id: 15,
                            type: 'image',
                            content: '/images/vocabulary/watch-tv.jpg',
                            pair: 'watch TV'
                        },
                        {
                            id: 16,
                            type: 'word',
                            content: 'watch TV',
                            pair: 'watch-tv.jpg'
                        },
                        {
                            id: 17,
                            type: 'image',
                            content: '/images/vocabulary/get-dressed.jpg',
                            pair: 'get dressed'
                        },
                        {
                            id: 18,
                            type: 'word',
                            content: 'get dressed',
                            pair: 'get-dressed.jpg'
                        },
                        {
                            id: 19,
                            type: 'image',
                            content: '/images/vocabulary/have-dinner.jpg',
                            pair: 'have dinner'
                        },
                        {
                            id: 20,
                            type: 'word',
                            content: 'have dinner',
                            pair: 'have-dinner.jpg'
                        }
                    ];

                    this.flippedCards = [];
                    this.matchedPairs = 0;
                    this.moves = 0;
                    this.isLocked = false;
                    this.startTime = null;
                    this.timerInterval = null;

                    this.grid = document.getElementById('memoryGrid');
                    this.moveCount = document.getElementById('moveCount');
                    this.matchCount = document.getElementById('matchCount');
                    this.timerDisplay = document.getElementById('memoryGameTimer');

                    this.initialize();
                }

                initialize() {
                    this.shuffleCards();
                    this.renderCards();
                    this.startTimer();
                }

                shuffleCards() {
                    for (let i = this.cards.length - 1; i > 0; i--) {
                        const j = Math.floor(Math.random() * (i + 1));
                        [this.cards[i], this.cards[j]] = [this.cards[j], this.cards[i]];
                    }
                }

                renderCards() {
                    this.grid.innerHTML = '';
                    this.cards.forEach((card, index) => {
                        const cardElement = document.createElement('div');
                        cardElement.className = 'memory-card';
                        cardElement.dataset.index = index;

                        cardElement.innerHTML = `
                    <div class="memory-card-inner">
                        <div class="memory-card-front">
                            ${index + 1}
                    </div>
                        <div class="memory-card-back">
                            ${card.type === 'image'
                                ? `<img src="${card.content}" alt="${card.pair}">`
                                : `<div class="word">${card.content}</div>`
                            }
                            </div>
                            </div>
                `;

                        cardElement.addEventListener('click', () => this.flipCard(cardElement, card));
                        this.grid.appendChild(cardElement);
                    });
                }

                flipCard(element, card) {
                    if (this.isLocked || element.classList.contains('flipped') || element.classList.contains(
                            'matched')) {
                        return;
                    }

                    element.classList.add('flipped');
                    this.flippedCards.push({
                        element,
                        card
                    });

                    if (this.flippedCards.length === 2) {
                        this.moves++;
                        this.moveCount.textContent = this.moves;
                        this.isLocked = true;
                        this.checkMatch();
                    }
                }

                checkMatch() {
                    const [first, second] = this.flippedCards;
                    const isMatch = first.card.pair === second.card.content || second.card.pair === first.card
                        .content;

                    if (isMatch) {
                        this.handleMatch(first.element, second.element);
                    } else {
                        this.handleMismatch(first.element, second.element);
                    }
                }

                handleMatch(firstCard, secondCard) {
                    firstCard.classList.add('matched');
                    secondCard.classList.add('matched');
                    this.matchedPairs++;
                    this.matchCount.textContent = this.matchedPairs;

                    this.flippedCards = [];
                    this.isLocked = false;

                    if (this.matchedPairs === 10) {
                        this.handleGameComplete();
                    }
                }

                handleMismatch(firstCard, secondCard) {
                    firstCard.classList.add('wrong');
                    secondCard.classList.add('wrong');

                    setTimeout(() => {
                        firstCard.classList.remove('flipped', 'wrong');
                        secondCard.classList.remove('flipped', 'wrong');
                        this.flippedCards = [];
                        this.isLocked = false;
                    }, 1000);
                }

                startTimer() {
                    this.startTime = Date.now();
                    this.timerInterval = setInterval(() => {
                        const elapsed = Math.floor((Date.now() - this.startTime) / 1000);
                        const minutes = Math.floor(elapsed / 60);
                        const seconds = elapsed % 60;
                        this.timerDisplay.textContent =
                            `${minutes}:${seconds.toString().padStart(2, '0')}`;
                    }, 1000);
                }

                handleGameComplete() {
                    clearInterval(this.timerInterval);
                    const timeSpent = this.timerDisplay.textContent;

                    const messageHTML = `
                <div class="alert alert-success mt-4">
                    <h4 class="alert-heading">Chúc mừng! 🎉</h4>
                    <p>Bạn đã hoàn thành trò chơi!</p>
                    <hr>
                    <p class="mb-0">
                        ⏱️ Thời gian: ${timeSpent}<br>
                        🔄 Số lần lật: ${this.moves}<br>
                        ✅ Số cặp đã ghép: ${this.matchedPairs}/10
                    </p>
                    <div class="mt-3">
                        <button class="btn btn-primary" onclick="window.location.reload()">
                            <i class="fas fa-redo me-2"></i>Chơi lại
                        </button>
                        </div>
                </div>
            `;

                    const messageElement = document.createElement('div');
                    messageElement.innerHTML = messageHTML;
                    this.grid.parentNode.appendChild(messageElement);
                }
            }

            // Initialize Memory Game
            new MemoryGame();

            // Fruit Slicing Game
            class FruitGame {
                constructor() {
                    this.canvas = document.getElementById('fruitCanvas');
                    this.ctx = this.canvas.getContext('2d');
                    this.fruits = [];
                    this.score = 0;
                    this.isPlaying = false;
                    this.currentQuestion = null;
                    this.questions = [{
                            question: "What is the past tense of 'go'?",
                            correct: "went",
                            options: ["gone", "went", "going", "goed"]
                        },
                        {
                            question: "Which word means 'a place where you buy medicines'?",
                            correct: "pharmacy",
                            options: ["hospital", "pharmacy", "supermarket", "bookstore"]
                        },
                        {
                            question: "Choose the correct spelling:",
                            correct: "beautiful",
                            options: ["beutiful", "beautiful", "beautifull", "butiful"]
                        },
                        {
                            question: "What is the opposite of 'happy'?",
                            correct: "sad",
                            options: ["glad", "sad", "excited", "angry"]
                        },
                        {
                            question: "Complete the sentence: 'She ___ to school every day.'",
                            correct: "goes",
                            options: ["go", "goes", "going", "went"]
                        },
                        {
                            question: "Which is a color?",
                            correct: "purple",
                            options: ["table", "purple", "pencil", "book"]
                        },
                        {
                            question: "What do you use to write?",
                            correct: "pen",
                            options: ["pen", "cup", "plate", "shoe"]
                        },
                        {
                            question: "Choose the correct plural: Child → ",
                            correct: "children",
                            options: ["childs", "childes", "children", "child"]
                        },
                        {
                            question: "What is 'con mèo' in English?",
                            correct: "cat",
                            options: ["dog", "cat", "bird", "fish"]
                        },
                        {
                            question: "Which is a fruit?",
                            correct: "apple",
                            options: ["carrot", "apple", "potato", "onion"]
                        },
                        {
                            question: "What is the past tense of 'eat'?",
                            correct: "ate",
                            options: ["eat", "ate", "eaten", "eating"]
                        },
                        {
                            question: "Choose the correct article: '___ umbrella'",
                            correct: "an",
                            options: ["a", "an", "the", "this"]
                        },
                        {
                            question: "What season comes after summer?",
                            correct: "autumn",
                            options: ["spring", "winter", "autumn", "summer"]
                        },
                        {
                            question: "Which word means 'very big'?",
                            correct: "huge",
                            options: ["small", "tiny", "huge", "little"]
                        },
                        {
                            question: "What is 'bàn' in English?",
                            correct: "table",
                            options: ["chair", "table", "desk", "bed"]
                        },
                        {
                            question: "Choose the correct time: '8:30'",
                            correct: "half past eight",
                            options: ["half to eight", "half past eight", "eight and half",
                                "eight thirty past"
                            ]
                        },
                        {
                            question: "What do you wear on your feet?",
                            correct: "shoes",
                            options: ["hat", "glasses", "shoes", "gloves"]
                        },
                        {
                            question: "Which animal can fly?",
                            correct: "bird",
                            options: ["fish", "cat", "bird", "snake"]
                        },
                        {
                            question: "What is the opposite of 'hot'?",
                            correct: "cold",
                            options: ["warm", "cool", "cold", "nice"]
                        },
                        {
                            question: "Choose the correct preposition: 'The book is ___ the table.'",
                            correct: "on",
                            options: ["in", "on", "at", "to"]
                        },
                        {
                            question: "What do you use to take pictures?",
                            correct: "camera",
                            options: ["phone", "camera", "computer", "tablet"]
                        },
                        {
                            question: "Which is a vegetable?",
                            correct: "carrot",
                            options: ["apple", "banana", "carrot", "orange"]
                        },
                        {
                            question: "What is 'mưa' in English?",
                            correct: "rain",
                            options: ["snow", "rain", "wind", "cloud"]
                        },
                        {
                            question: "Choose the correct number: 'twenty + thirty = ___'",
                            correct: "fifty",
                            options: ["forty", "fifty", "sixty", "seventy"]
                        },
                        {
                            question: "What do you drink when you're thirsty?",
                            correct: "water",
                            options: ["bread", "rice", "water", "cake"]
                        }
                    ];

                    // Thiết lập kích thước canvas
                    this.resizeCanvas();
                    window.addEventListener('resize', () => this.resizeCanvas());

                    // Fruit images preload
                    this.fruitImages = {
                        apple: this.loadImage('/images/fruits/apple.png'),
                        orange: this.loadImage('/images/fruits/orange.png'),
                        banana: this.loadImage('/images/fruits/banana.png'),
                        pear: this.loadImage('/images/fruits/pear.png'),
                    };

                    // Khởi tạo sự kiện
                    this.initializeEvents();
                }

                resizeCanvas() {
                    const container = this.canvas.parentElement;
                    this.canvas.width = container.offsetWidth;
                    this.canvas.height = container.offsetHeight;
                }

                loadImage(src) {
                    const img = new Image();
                    img.src = src;
                    return img;
                }

                initializeEvents() {
                    document.getElementById('startGame').addEventListener('click', () => this.startGame());

                    this.canvas.addEventListener('click', (e) => {
                        if (!this.isPlaying) return;

                        const rect = this.canvas.getBoundingClientRect();
                        const x = e.clientX - rect.left;
                        const y = e.clientY - rect.top;

                        this.checkFruitHit(x, y);
                    });
                }

                startGame() {
                    this.isPlaying = true;
                    document.getElementById('startGame').style.display = 'none';
                    this.setNewQuestion();
                    this.gameLoop();
                }

                setNewQuestion() {
                    this.currentQuestion = this.questions[Math.floor(Math.random() * this.questions.length)];
                    document.getElementById('fruitQuestion').textContent = this.currentQuestion.question;
                }

                createFruit() {
                    const fruitTypes = Object.keys(this.fruitImages);
                    const options = [...this.currentQuestion.options];

                    // Tạo nhiều fruit cùng lúc
                    for (let i = 0; i < 3; i++) {
                        const fruit = {
                            x: Math.random() * (this.canvas.width - 100) + 50,
                            y: this.canvas.height + 50,
                            speedY: -(Math.random() * 3 + 4), // Giảm tốc độ bay lên (từ -8 xuống -4)
                            speedX: (Math.random() - 0.5) * 2, // Giảm tốc độ di chuyển ngang
                            rotation: Math.random() * Math.PI * 2,
                            type: fruitTypes[Math.floor(Math.random() * fruitTypes.length)],
                            answer: options.splice(Math.floor(Math.random() * options.length), 1)[0],
                            size: 100, // Tăng kích thước ban đầu
                            growing: true,
                            maxSize: 150, // Tăng kích thước tối đa
                            minSize: 100, // Tăng kích thước tối thiểu
                            sizeSpeed: 0.3, // Giảm tốc độ thay đổi kích thước
                            gravity: 0.05 // Thêm trọng lực nhỏ hơn (từ 0.15 xuống 0.05)
                        };
                        this.fruits.push(fruit);
                    }
                }

                checkFruitHit(x, y) {
                    for (let i = this.fruits.length - 1; i >= 0; i--) {
                        const fruit = this.fruits[i];
                        const distance = Math.sqrt(
                            Math.pow(x - fruit.x, 2) + Math.pow(y - fruit.y, 2)
                        );

                        if (distance < fruit.size / 2) {
                            if (fruit.answer === this.currentQuestion.correct) {
                                this.score += 10;
                                document.getElementById('fruitScore').textContent = this.score;
                                this.fruits.splice(i, 1);
                                this.showEffect('correct', x, y);
                                this.showScorePopup('+10', x, y);
                                setTimeout(() => this.setNewQuestion(), 1000);
                            } else {
                                this.showEffect('wrong', x, y);
                                this.showScorePopup('-5', x, y, true);
                                this.score = Math.max(0, this.score - 5);
                                document.getElementById('fruitScore').textContent = this.score;
                            }
                        }
                    }
                }

                showEffect(type, x, y) {
                    const effect = document.createElement('div');
                    effect.className = `fruit-effect ${type}`;
                    effect.style.left = `${x}px`;
                    effect.style.top = `${y}px`;

                    // Thêm âm thanh
                    const audio = new Audio();
                    audio.src = type === 'correct' ? '/sounds/correct.mp3' : '/sounds/wrong.mp3';
                    audio.volume = 0.5;
                    audio.play().catch(e => console.log('Audio play failed:', e));

                    // Thêm hiệu ứng rung màn hình khi trả lời sai
                    if (type === 'wrong') {
                        this.canvas.style.animation = 'shake 0.5s';
                        setTimeout(() => {
                            this.canvas.style.animation = '';
                        }, 500);
                    }

                    this.canvas.parentElement.appendChild(effect);
                    setTimeout(() => effect.remove(), 500);
                }

                showScorePopup(score, x, y, isNegative = false) {
                    const popup = document.createElement('div');
                    popup.className = 'score-popup';
                    popup.textContent = score;
                    popup.style.left = `${x}px`;
                    popup.style.top = `${y}px`;
                    popup.style.color = isNegative ? '#ff4444' : '#44ff44';

                    this.canvas.parentElement.appendChild(popup);
                    setTimeout(() => popup.remove(), 1000);
                }

                update() {
                    // Cập nhật vị trí và trạng thái của fruits
                    for (let i = this.fruits.length - 1; i >= 0; i--) {
                        const fruit = this.fruits[i];

                        // Cập nhật vị trí
                        fruit.y += fruit.speedY;
                        fruit.x += fruit.speedX;
                        fruit.rotation += 0.01; // Giảm tốc độ xoay (từ 0.02 xuống 0.01)

                        // Thay đổi kích thước
                        if (fruit.growing) {
                            fruit.size += fruit.sizeSpeed;
                            if (fruit.size >= fruit.maxSize) {
                                fruit.growing = false;
                            }
                        } else {
                            fruit.size -= fruit.sizeSpeed;
                            if (fruit.size <= fruit.minSize) {
                                fruit.growing = true;
                            }
                        }

                        // Giảm tốc độ khi bay lên với trọng lực nhỏ hơn
                        fruit.speedY += fruit.gravity;

                        // Xóa fruit khi rơi xuống dưới màn hình (thêm khoảng cách)
                        if (fruit.y > this.canvas.height + 200) {
                            this.fruits.splice(i, 1);
                        }
                    }

                    // Giảm tần suất tạo fruits mới
                    if (this.fruits.length < 3 && Math.random() < 0.01) { // Giảm từ 0.02 xuống 0.01
                        this.createFruit();
                    }
                }

                draw() {
                    this.ctx.clearRect(0, 0, this.canvas.width, this.canvas.height);

                    // Vẽ từng fruit
                    this.fruits.forEach(fruit => {
                        this.ctx.save();
                        this.ctx.translate(fruit.x, fruit.y);
                        this.ctx.rotate(fruit.rotation);

                        // Vẽ hình ảnh fruit
                        const img = this.fruitImages[fruit.type];
                        this.ctx.drawImage(
                            img,
                            -fruit.size / 2,
                            -fruit.size / 2,
                            fruit.size,
                            fruit.size
                        );

                        // Vẽ text đáp án
                        this.ctx.textAlign = 'center';
                        this.ctx.textBaseline = 'middle';
                        this.ctx.fillStyle = 'white';
                        this.ctx.strokeStyle = 'black';
                        this.ctx.lineWidth = 3;
                        this.ctx.font = '20px Arial';
                        this.ctx.strokeText(fruit.answer, 0, 0);
                        this.ctx.fillText(fruit.answer, 0, 0);

                        this.ctx.restore();
                    });
                }

                gameLoop() {
                    if (!this.isPlaying) return;

                    this.update();
                    this.draw();
                    requestAnimationFrame(() => this.gameLoop());
                }
            }

            // Initialize Fruit Game when document is ready
            new FruitGame();

            class CategoryGame {
                constructor() {
                    this.score = 0;
                    this.items = [{
                            id: 'backpack',
                            src: '/images/items/backpack.png',
                            category: 'school-supplies'
                        },
                        {
                            id: 'icecream',
                            src: '/images/items/icecream.png',
                            category: 'food'
                        },
                        {
                            id: 'glue',
                            src: '/images/items/glue.png',
                            category: 'school-supplies'
                        },
                        {
                            id: 'fish',
                            src: '/images/items/fish.png',
                            category: 'food'
                        },
                        {
                            id: 'train',
                            src: '/images/items/train.png',
                            category: 'toys'
                        },
                        {
                            id: 'pencil',
                            src: '/images/items/pencil.png',
                            category: 'school-supplies'
                        },
                        {
                            id: 'rice',
                            src: '/images/items/rice.png',
                            category: 'food'
                        },
                        {
                            id: 'face',
                            src: '/images/items/face.png',
                            category: 'body-parts'
                        },
                        {
                            id: 'soccer',
                            src: '/images/items/soccer.png',
                            category: 'toys'
                        },
                        {
                            id: 'ruler',
                            src: '/images/items/ruler.png',
                            category: 'school-supplies'
                        },
                        {
                            id: 'pizza',
                            src: '/images/items/pizza.png',
                            category: 'food'
                        },
                        {
                            id: 'mouth',
                            src: '/images/items/mouth.png',
                            category: 'body-parts'
                        },
                        {
                            id: 'foot',
                            src: '/images/items/foot.png',
                            category: 'body-parts'
                        },
                        {
                            id: 'kite',
                            src: '/images/items/kite.png',
                            category: 'toys'
                        },
                        {
                            id: 'arm',
                            src: '/images/items/arm.png',
                            category: 'body-parts'
                        },
                        {
                            id: 'car',
                            src: '/images/items/car.png',
                            category: 'toys'
                        }
                    ];

                    this.initialize();
                }

                initialize() {
                    // Shuffle items
                    this.shuffleItems();

                    // Populate source container
                    const imagesList = document.getElementById('imagesList');
                    this.items.forEach(item => {
                        const itemElement = this.createDraggableItem(item);
                        imagesList.appendChild(itemElement);
                    });

                    // Setup drag and drop listeners
                    this.setupDragAndDrop();
                }

                shuffleItems() {
                    for (let i = this.items.length - 1; i > 0; i--) {
                        const j = Math.floor(Math.random() * (i + 1));
                        [this.items[i], this.items[j]] = [this.items[j], this.items[i]];
                    }
                }

                createDraggableItem(item) {
                    const div = document.createElement('div');
                    div.className = 'draggable-item';
                    div.draggable = true;
                    div.dataset.id = item.id;
                    div.dataset.category = item.category;

                    const img = document.createElement('img');
                    img.src = item.src;
                    img.alt = item.id;
                    div.appendChild(img);

                    return div;
                }

                setupDragAndDrop() {
                    const draggableItems = document.querySelectorAll('.draggable-item');
                    const categoryItems = document.querySelectorAll('.category-items');

                    draggableItems.forEach(item => {
                        item.addEventListener('dragstart', (e) => {
                            item.classList.add('dragging');
                            e.dataTransfer.setData('text/plain', JSON.stringify({
                                id: item.dataset.id,
                                category: item.dataset.category,
                                src: item.querySelector('img').src
                            }));
                        });

                        item.addEventListener('dragend', () => {
                            item.classList.remove('dragging');
                        });
                    });

                    categoryItems.forEach(container => {
                        container.addEventListener('dragover', (e) => {
                            e.preventDefault();
                            container.classList.add('dragover');
                        });

                        container.addEventListener('dragleave', () => {
                            container.classList.remove('dragover');
                        });

                        container.addEventListener('drop', (e) => {
                            e.preventDefault();
                            container.classList.remove('dragover');

                            const data = JSON.parse(e.dataTransfer.getData('text/plain'));
                            const targetCategory = container.id.replace('Category', '');
                            const isCorrect = this.checkCategory(data.category, targetCategory);

                            if (isCorrect) {
                                this.handleCorrectDrop(container, data);
                            } else {
                                this.handleIncorrectDrop(container);
                            }
                        });
                    });
                }

                checkCategory(itemCategory, targetCategory) {
                    const categoryMap = {
                        'food': 'food',
                        'school-supplies': 'supplies',
                        'toys': 'toys',
                        'body-parts': 'body'
                    };
                    return itemCategory === Object.keys(categoryMap).find(key => categoryMap[key] ===
                        targetCategory);
                }

                handleCorrectDrop(container, data) {
                    // Create dropped item
                    const droppedItem = document.createElement('div');
                    droppedItem.className = 'dropped-item';
                    droppedItem.innerHTML = `
                <img src="${data.src}" alt="${data.id}">
                <button class="remove-item" onclick="this.parentElement.remove()">
                    <i class="fas fa-times"></i>
                            </button>
            `;

                    // Add to container
                    container.appendChild(droppedItem);

                    // Remove original item
                    document.querySelector(`[data-id="${data.id}"]`).remove();

                    // Update score
                    this.score += 10;
                    document.getElementById('categorizationScore').textContent = this.score;

                    // Show feedback
                    this.showFeedback(container, true);

                    // Check if game is complete
                    if (document.querySelectorAll('.draggable-item').length === 0) {
                        this.showCompletionMessage();
                    }
                }

                handleIncorrectDrop(container) {
                    // Show feedback
                    this.showFeedback(container, false);

                    // Deduct points
                    this.score = Math.max(0, this.score - 5);
                    document.getElementById('categorizationScore').textContent = this.score;
                }

                showFeedback(container, isCorrect) {
                    const feedback = document.createElement('div');
                    feedback.className = `category-feedback ${isCorrect ? 'correct' : 'wrong'}`;
                    feedback.textContent = isCorrect ? '✓ Correct!' : '✗ Try Again';
                    container.appendChild(feedback);

                    // Play sound
                    const audio = new Audio();
                    audio.src = isCorrect ? '/sounds/correct.mp3' : '/sounds/wrong.mp3';
                    audio.volume = 0.5;
                    audio.play().catch(e => console.log('Audio play failed:', e));

                    setTimeout(() => feedback.remove(), 1000);
                }

                showCompletionMessage() {
                    const messageHTML = `
                <div class="alert alert-success mt-4">
                    <h4 class="alert-heading">Chúc mừng! 🎉</h4>
                    <p>Bạn đã hoàn thành trò chơi phân loại!</p>
                    <hr>
                    <p class="mb-0">Điểm số của bạn: ${this.score}</p>
                    <div class="mt-3">
                        <button class="btn btn-primary" onclick="window.location.reload()">
                            <i class="fas fa-redo me-2"></i>Chơi lại
                            </button>
                        </div>
                    </div>
            `;

                    const messageElement = document.createElement('div');
                    messageElement.innerHTML = messageHTML;
                    document.querySelector('.categorization-game').appendChild(messageElement);
                }
            }

            // Initialize Category Game
            new CategoryGame();

            // Word Search Game
            class WordSearchGame {
                constructor() {
                    this.grid = document.getElementById('wordSearchGrid');
                    this.wordList = document.getElementById('wordList');
                    this.score = 0;
                    this.selectedCells = [];
                    this.foundWords = new Set();
                    this.words = [
                        'DONKEY', 'SHEEP', 'CHICKEN', 'DUCK', 'FEATHERS',
                        'FROG', 'HORSE', 'RABBIT', 'ANIMALS', 'GOAT', 'TURTLE'
                    ];
                    this.gridSize = 12;
                    this.board = [];
                    this.directions = [
                        [0, 1], // right
                        [1, 0], // down
                        [1, 1], // diagonal down-right
                        [-1, 1], // diagonal up-right
                        [0, -1], // left
                        [-1, 0], // up
                        [-1, -1], // diagonal up-left
                        [1, -1] // diagonal down-left
                    ];

                    this.initialize();
                }

                initialize() {
                    this.initializeBoard();
                    this.placeWords();
                    this.fillEmptyCells();
                    this.renderGrid();
                    this.renderWordList();
                    this.setupEventListeners();
                }

                initializeBoard() {
                    this.board = Array(this.gridSize).fill().map(() => Array(this.gridSize).fill(''));
                }

                placeWords() {
                    this.words.forEach(word => {
                        let placed = false;
                        let attempts = 0;
                        const maxAttempts = 100;

                        while (!placed && attempts < maxAttempts) {
                            const direction = this.directions[Math.floor(Math.random() * this.directions
                                .length)];
                            const startX = Math.floor(Math.random() * this.gridSize);
                            const startY = Math.floor(Math.random() * this.gridSize);

                            if (this.canPlaceWord(word, startX, startY, direction)) {
                                this.placeWord(word, startX, startY, direction);
                                placed = true;
                            }
                            attempts++;
                        }
                    });
                }

                canPlaceWord(word, startX, startY, [dx, dy]) {
                    const length = word.length;

                    // Check if word fits on board
                    for (let i = 0; i < length; i++) {
                        const x = startX + i * dx;
                        const y = startY + i * dy;

                        if (x < 0 || x >= this.gridSize || y < 0 || y >= this.gridSize) {
                            return false;
                        }

                        // Check if cell is empty or has matching letter
                        if (this.board[x][y] !== '' && this.board[x][y] !== word[i]) {
                            return false;
                        }
                    }

                    return true;
                }

                placeWord(word, startX, startY, [dx, dy]) {
                    for (let i = 0; i < word.length; i++) {
                        const x = startX + i * dx;
                        const y = startY + i * dy;
                        this.board[x][y] = word[i];
                    }
                }

                fillEmptyCells() {
                    const letters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
                    for (let i = 0; i < this.gridSize; i++) {
                        for (let j = 0; j < this.gridSize; j++) {
                            if (this.board[i][j] === '') {
                                this.board[i][j] = letters[Math.floor(Math.random() * letters.length)];
                            }
                        }
                    }
                }

                renderGrid() {
                    this.grid.innerHTML = '';
                    for (let i = 0; i < this.gridSize; i++) {
                        const row = document.createElement('div');
                        row.className = 'row g-0';
                        for (let j = 0; j < this.gridSize; j++) {
                            const cell = document.createElement('div');
                            cell.className = 'grid-cell';
                            cell.textContent = this.board[i][j];
                            cell.dataset.row = i;
                            cell.dataset.col = j;
                            row.appendChild(cell);
                        }
                        this.grid.appendChild(row);
                    }
                }

                renderWordList() {
                    this.wordList.innerHTML = '';
                    this.words.forEach(word => {
                        const wordItem = document.createElement('div');
                        wordItem.className = 'word-item';
                        wordItem.textContent = word;
                        this.wordList.appendChild(wordItem);
                    });
                }

                setupEventListeners() {
                    const cells = this.grid.querySelectorAll('.grid-cell');

                    cells.forEach(cell => {
                        // Single click handling
                        cell.addEventListener('click', (e) => {
                            const clickedCell = e.target;

                            // Toggle selection of clicked cell
                            if (clickedCell.classList.contains('selected')) {
                                clickedCell.classList.remove('selected');
                                this.selectedCells = this.selectedCells.filter(c => c !==
                                    clickedCell);
                            } else {
                                clickedCell.classList.add('selected');
                                this.selectedCells.push(clickedCell);
                            }

                            // Check if selected cells form a valid word
                            const selectedWord = this.getSelectedWord();
                            if (this.words.includes(selectedWord) && !this.foundWords.has(
                                    selectedWord)) {
                                this.handleWordFound(selectedWord);
                            }
                        });
                    });

                    document.getElementById('checkWords').addEventListener('click', () => this.checkProgress());
                    document.getElementById('resetGame').addEventListener('click', () => this.resetGame());
                }

                clearSelection() {
                    if (this.selectedCells) {
                        this.selectedCells.forEach(cell => {
                            if (cell && cell.classList) {
                                cell.classList.remove('selected');
                            }
                        });
                        this.selectedCells = [];
                    }
                }

                getSelectedWord() {
                    if (!this.selectedCells) return '';
                    return this.selectedCells
                        .filter(cell => cell && cell.textContent)
                        .map(cell => cell.textContent)
                        .join('');
                }

                handleWordFound(word) {
                    this.foundWords.add(word);
                    this.score += 10;
                    document.getElementById('wordSearchScore').textContent = this.score;

                    // Highlight found word in grid with a unique color
                    const colors = [
                        '#FF9999', '#99FF99', '#9999FF', '#FFFF99',
                        '#FF99FF', '#99FFFF', '#FFB366', '#B366FF'
                    ];
                    const colorIndex = this.foundWords.size % colors.length;
                    const highlightColor = colors[colorIndex];

                    this.selectedCells.forEach(cell => {
                        cell.classList.remove('selected');
                        cell.classList.add('highlighted');
                        cell.style.backgroundColor = highlightColor;
                    });

                    // Mark word as found in list
                    const wordItem = Array.from(this.wordList.children)
                        .find(item => item.textContent === word);
                    if (wordItem) {
                        wordItem.classList.add('found');
                        wordItem.style.backgroundColor = highlightColor;
                    }

                    // Play success sound
                    const audio = new Audio('/sounds/correct.mp3');
                    audio.volume = 0.5;
                    audio.play().catch(e => console.log('Audio play failed:', e));

                    // Show success message with SweetAlert
                    Swal.fire({
                        title: 'Tuyệt vời!',
                        text: `Bạn đã tìm thấy từ "${word}"!`,
                        icon: 'success',
                        timer: 1500,
                        showConfirmButton: false,
                        position: 'top-end',
                        toast: true
                    });

                    // Check if game is complete
                    if (this.foundWords.size === this.words.length) {
                        this.showCompletionMessage();
                    }
                }

                showCompletionMessage() {
                    Swal.fire({
                        title: 'Chúc mừng!',
                        text: 'Bạn đã tìm thấy tất cả các từ!',
                        icon: 'success',
                        confirmButtonText: 'Chơi lại',
                        showCancelButton: true,
                        cancelButtonText: 'Đóng'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            this.resetGame();
                        }
                    });
                }

                checkProgress() {
                    if (this.foundWords.size === this.words.length) {
                        this.showCompletionMessage();
                    } else {
                        Swal.fire({
                            title: 'Chưa hoàn thành!',
                            text: 'Bạn chưa tìm được tất cả các từ. Vui lòng thử lại!',
                            icon: 'info',
                            confirmButtonText: 'Tiếp tục'
                        });
                    }
                }

                resetGame() {
                    // Reset game state
                    this.foundWords.clear();
                    this.score = 0;
                    document.getElementById('wordSearchScore').textContent = this.score;

                    // Clear all highlights and colors
                    const cells = this.grid.querySelectorAll('.grid-cell');
                    cells.forEach(cell => {
                        cell.classList.remove('highlighted', 'selected');
                        cell.style.backgroundColor = '';
                    });

                    // Reset word list and remove colors
                    const wordItems = this.wordList.querySelectorAll('.word-item');
                    wordItems.forEach(item => {
                        item.classList.remove('found');
                        item.style.backgroundColor = '';
                    });

                    // Regenerate the board
                    this.initializeBoard();
                    this.placeWords();
                    this.fillEmptyCells();
                    this.renderGrid();

                    // Show reset message
                    Swal.fire({
                        title: 'Đã làm mới!',
                        text: 'Trò chơi đã được thiết lập lại.',
                        icon: 'info',
                        timer: 1500,
                        showConfirmButton: false,
                        position: 'top-end',
                        toast: true
                    });
                }
            }

            // Initialize Word Search Game
            new WordSearchGame();
        });
    </script>
@endpush
