<?php

return [
    'courses' => [
        'basic' => [
            'id' => 1,
            'name' => 'Basic IELTS Course',
            'duration' => '3 months',
            'total_lessons' => 12,
            'level' => 'Basic',
            'description' => 'Basic IELTS course for beginners, helping to build a solid foundation for the IELTS exam.',
            'lessons' => [
                [
                    'id' => 1,
                    'name' => 'IELTS Introduction and Overview',
                    'structure' => [
                        'before_class' => [
                            'us_movie' => [
                                'title' => 'U.S. MOVIE',
                                'icon' => 'fas fa-film',
                                'icon_color' => 'text-danger',
                                'description' => 'Watch Young Sheldon Episode 1: Introduction to IELTS',
                                'route' => 'online.video-exercise.show',
                                'video_id' => 'basic_1_1'
                            ],
                            'active_listening' => [
                                'title' => 'ACTIVE LISTENING',
                                'icon' => 'fas fa-headphones',
                                'icon_color' => 'text-info',
                                'description' => 'Basic IELTS listening practice with common topics',
                                'route' => 'online.vocabulary-listening.show',
                                'material_id' => 'basic_1_2'
                            ]
                        ],
                        'during_class' => [
                            'pronunciation' => [
                                'title' => 'PRONUNCIATION',
                                'icon' => 'fas fa-film',
                                'icon_color' => 'text-primary',
                                'description' => 'Basic pronunciation rules and practice',
                                'route' => 'online.video-handout.show',
                                'material_id' => 'basic_1_3'
                            ],
                            'grammar_practice' => [
                                'title' => 'SHADOWING PRACTICE',
                                'icon' => 'fas fa-book',
                                'icon_color' => 'text-success',
                                'description' => 'Shadowing practice',
                                'route' => 'online.video-shadowing.show',
                                'material_id' => 'basic_1_4'
                            ]
                        ],
                        'after_class' => [
                            'reflection' => [
                                'title' => 'REFLECTION',
                                'icon' => 'fas fa-pen-fancy',
                                'icon_color' => 'text-primary',
                                'description' => 'Write your thoughts about IELTS basics',
                                'route' => 'online.reflection-exercise.show',
                                'exercise_id' => 'basic_1_5'
                            ]
                        ]
                    ]
                ],
                [
                    'id' => 2,
                    'name' => 'Basic Writing Skills',
                    'structure' => [
                        'before_class' => [
                            'us_movie' => [
                                'title' => 'U.S. MOVIE',
                                'icon' => 'fas fa-film',
                                'icon_color' => 'text-danger',
                                'description' => 'Watch Young Sheldon Episode 1: Introduction to IELTS',
                                'route' => 'online.video-exercise.show',
                                'video_id' => 'basic_2_1'
                            ],
                            'active_listening' => [
                                'title' => 'ACTIVE LISTENING',
                                'icon' => 'fas fa-headphones',
                                'icon_color' => 'text-info',
                                'description' => 'Listen and learn basic writing vocabulary',
                                'route' => 'online.vocabulary-listening.show',
                                'material_id' => 'basic_2_2'
                            ]
                        ],
                        'during_class' => [
                            'writing_practice' => [
                                'title' => 'WRITING PRACTICE',
                                'icon' => 'fas fa-pencil-alt',
                                'icon_color' => 'text-success',
                                'description' => 'Practice basic sentence structures',
                                'route' => 'online.video-handout.show',
                                'material_id' => 'basic_2_3'
                            ]
                        ],
                        'after_class' => [
                            'reflection' => [
                                'title' => 'REFLECTION',
                                'icon' => 'fas fa-pen-fancy',
                                'icon_color' => 'text-primary',
                                'description' => 'Write your thoughts about IELTS basics',
                                'route' => 'online.reflection-exercise.show',
                                'exercise_id' => 'basic_2_4'
                            ]
                        ]
                    ]
                ],
                [
                    'id' => 3,
                    'name' => 'Basic Reading Skills',
                    'structure' => [
                        'before_class' => [
                            'active_listening' => [
                                'title' => 'ACTIVE LISTENING',
                                'icon' => 'fas fa-headphones',
                                'icon_color' => 'text-info',
                                'description' => 'Listen and learn basic writing vocabulary',
                                'route' => 'online.vocabulary-listening.show',
                                'material_id' => 'basic_2_1'
                            ]
                        ],
                        'during_class' => [
                            'writing_practice' => [
                                'title' => 'WRITING PRACTICE',
                                'icon' => 'fas fa-pencil-alt',
                                'icon_color' => 'text-success',
                                'description' => 'Practice basic sentence structures',
                                'route' => 'online.video-handout.show',
                                'exercise_id' => 'basic_2_2'
                            ]
                        ]
                    ]
                ],
                [
                    'id' => 4,
                    'name' => 'Basic Speaking Skills',
                    'structure' => [
                        'before_class' => [
                            'us_movie' => [
                                'title' => 'U.S. MOVIE',
                                'icon' => 'fas fa-film',
                                'icon_color' => 'text-danger',
                                'description' => 'Watch Young Sheldon Episode 1: Introduction to IELTS',
                                'route' => 'online.video-exercise.show',
                                'video_id' => 'basic_1_1'
                            ],
                            'active_listening' => [
                                'title' => 'ACTIVE LISTENING',
                                'icon' => 'fas fa-headphones',
                                'icon_color' => 'text-info',
                                'description' => 'Basic IELTS listening practice with common topics',
                                'route' => 'online.vocabulary-listening.show',
                                'material_id' => 'basic_1_2'
                            ]
                        ],
                        'during_class' => [
                            'pronunciation' => [
                                'title' => 'PRONUNCIATION',
                                'icon' => 'fas fa-film',
                                'icon_color' => 'text-primary',
                                'description' => 'Basic pronunciation rules and practice',
                                'route' => 'online.video-handout.show',
                                'material_id' => 'basic_1_3'
                            ]
                        ],
                        'after_class' => [
                            'reflection' => [
                                'title' => 'REFLECTION',
                                'icon' => 'fas fa-pen-fancy',
                                'icon_color' => 'text-primary',
                                'description' => 'Write your thoughts about IELTS basics',
                                'route' => 'online.reflection-exercise.show',
                                'exercise_id' => 'basic_1_4'
                            ]
                        ]
                    ]
                ],
                // ... other lessons with their specific structures
            ]
        ],
        'intermediate' => [
            'id' => 2,
            'name' => 'Intermediate IELTS Course',
            'duration' => '4 months',
            'total_lessons' => 14,
            'level' => 'Intermediate',
            'description' => 'Intermediate IELTS course to enhance skills and aim for band scores 6.0-7.0.',
            'lessons' => [
                [
                    'id' => 1,
                    'name' => 'Introduction to IELTS Writing Task 1',
                    'structure' => [
                        'before_class' => [
                            'us_movie' => [
                                'title' => 'U.S. MOVIE',
                                'icon' => 'fas fa-film',
                                'icon_color' => 'text-danger',
                                'description' => 'Watch TED Talk: Data Visualization',
                                'route' => 'online.video-exercise.show',
                                'video_id' => 'intermediate_1_1'
                            ]
                        ],
                        'during_class' => [
                            'graph_analysis' => [
                                'title' => 'PRONUNCIATION',
                                'icon' => 'fas fa-chart-line',
                                'icon_color' => 'text-primary',
                                'description' => 'Learn to analyze different types of graphs',
                                'route' => 'online.summary-of-all-exercises.course-two.before.video-handout.show',
                                'material_id' => 'intermediate_1_2'
                            ],
                            'vocabulary_practice' => [
                                'title' => 'SHADOWING PRACTICE',
                                'icon' => 'fas fa-book',
                                'icon_color' => 'text-success',
                                'description' => 'Learn vocabulary for describing trends',
                                'route' => 'online.video-exercise.show',
                                'material_id' => 'intermediate_1_3'
                            ]
                        ],
                        'after_class' => [
                            'reflection' => [
                                'title' => 'REFLECTION',
                                'icon' => 'fas fa-pen-fancy',
                                'icon_color' => 'text-primary',
                                'description' => 'Write your thoughts about IELTS basics',
                                'route' => 'online.reflection-exercise.show',
                                'exercise_id' => 'intermediate_1_4'
                            ]
                        ]
                    ]
                ],
                [
                    'id' => 2,
                    'name' => 'Introduction to IELTS Writing Task 2',
                    'structure' => [
                        'before_class' => [
                            'us_movie' => [
                                'title' => 'U.S. MOVIE',
                                'icon' => 'fas fa-film',
                                'icon_color' => 'text-danger',
                                'description' => 'Watch TED Talk: Data Visualization',
                                'route' => 'online.video-exercise.show',
                                'video_id' => 'intermediate_1_1'
                            ]
                        ],
                        'during_class' => [
                            'graph_analysis' => [
                                'title' => 'PRONUNCIATION',
                                'icon' => 'fas fa-chart-line',
                                'icon_color' => 'text-primary',
                                'description' => 'Learn to analyze different types of graphs',
                                'route' => 'online.summary-of-all-exercises.course-two.before.video-handout.show2',
                                'material_id' => 'intermediate_1_2'
                            ],
                            'vocabulary_practice' => [
                                'title' => 'SHADOWING PRACTICE',
                                'icon' => 'fas fa-book',
                                'icon_color' => 'text-success',
                                'description' => 'Learn vocabulary for describing trends',
                                'route' => 'online.video-exercise.show',
                                'material_id' => 'intermediate_1_3'
                            ]
                        ],
                        'after_class' => [
                            'reflection' => [
                                'title' => 'REFLECTION',
                                'icon' => 'fas fa-pen-fancy',
                                'icon_color' => 'text-primary',
                                'description' => 'Write your thoughts about IELTS basics',
                                'route' => 'online.reflection-exercise.show',
                                'exercise_id' => 'intermediate_1_4'
                            ]
                        ]
                    ]
                ]
            ]
        ],
        'advanced' => [
            'id' => 3,
            'name' => 'Advanced IELTS Course',
            'duration' => '4 months',
            'total_lessons' => 20,
            'level' => 'Advanced',
            'description' => 'Advanced IELTS course for students aiming to achieve band scores 7.0-8.0.',
            'lessons' => [
                [
                    'id' => 1,
                    'name' => 'Advanced Writing Task 1 Analysis',
                    'structure' => [
                        'before_class' => [
                            'research_paper' => [
                                'title' => 'RESEARCH PAPER',
                                'icon' => 'fas fa-file-alt',
                                'icon_color' => 'text-info',
                                'description' => 'Read and analyze academic research papers',
                                'route' => 'online.research-paper.show',
                                'paper_id' => 'advanced_1_1'
                            ]
                        ],
                        'during_class' => [
                            'advanced_analysis' => [
                                'title' => 'ADVANCED ANALYSIS',
                                'icon' => 'fas fa-microscope',
                                'icon_color' => 'text-primary',
                                'description' => 'Complex data interpretation techniques',
                                'route' => 'online.advanced-analysis.show',
                                'exercise_id' => 'advanced_1_2'
                            ]
                        ],
                        'after_class' => [
                            'peer_review' => [
                                'title' => 'PEER REVIEW',
                                'icon' => 'fas fa-users',
                                'icon_color' => 'text-success',
                                'description' => 'Review and provide feedback on peer writings',
                                'route' => 'online.peer-review.show',
                                'review_id' => 'advanced_1_3'
                            ]
                        ]
                    ]
                ]
                // ... other advanced lessons
            ]
        ],
        'expert' => [
            'id' => 4,
            'name' => 'Expert IELTS Course',
            'duration' => '6 months',
            'total_lessons' => 21,
            'level' => 'Expert',
            'description' => 'Expert IELTS course helping students achieve band scores 8.0-9.0 and master all skills.',
            'lessons' => [
                [
                    'id' => 1,
                    'name' => 'Expert Writing Analysis Techniques',
                    'structure' => [
                        'before_class' => [
                            'academic_journal' => [
                                'title' => 'ACADEMIC JOURNAL',
                                'icon' => 'fas fa-journal-whills',
                                'icon_color' => 'text-danger',
                                'description' => 'Analyze high-impact academic journals',
                                'route' => 'online.academic-journal.show',
                                'journal_id' => 'expert_1_1'
                            ]
                        ],
                        'during_class' => [
                            'expert_writing' => [
                                'title' => 'EXPERT WRITING',
                                'icon' => 'fas fa-feather-alt',
                                'icon_color' => 'text-primary',
                                'description' => 'Advanced writing techniques workshop',
                                'route' => 'online.expert-writing.show',
                                'workshop_id' => 'expert_1_2'
                            ]
                        ],
                        'after_class' => [
                            'publication' => [
                                'title' => 'PUBLICATION',
                                'icon' => 'fas fa-book-open',
                                'icon_color' => 'text-success',
                                'description' => 'Prepare writing for academic publication',
                                'route' => 'online.publication.show',
                                'project_id' => 'expert_1_3'
                            ]
                        ]
                    ]
                ]
                // ... other expert lessons
            ]
        ]
    ]
];
