<?php
namespace App\Infrastructure;

use App\Domain\Repositories\QuestionRepository;

class MockQuestion implements QuestionRepository
{
    public function getDailyQuestion($themeName): array
    {
        return [
            [
                'id' => 1,
                'question' => 'What is the capital of France?',
                'answers' => [
                    [ 
                        'id' => 1,
                        'answer' => 'Paris',
                        'is_correct' => true
                    ],
                    [ 
                        'id' => 2,
                        'answer' => 'London',
                        'is_correct' => false
                    ],
                    [ 
                        'id' => 3,
                        'answer' => 'Berlin',
                        'is_correct' => false
                    ],
                    [ 
                        'id' => 4,
                        'answer' => 'Madrid',
                        'is_correct' => false
                    ],
                ],
            ],
            [
                'id' => 2,
                'question' => 'What is the capital of Germany?',
                'answers' => [
                    [
                        'id' => 1,
                        'answer' => 'Paris',
                        'is_correct' => false
                    ],
                    [
                        'id' => 2,
                        'answer' => 'London',
                        'is_correct' => false
                    ],
                    [
                        'id' => 3,
                        'answer' => 'Berlin',
                        'is_correct' => true
                    ],
                    [
                        'id' => 4,
                        'answer' => 'Madrid',
                        'is_correct' => false
                    ],
                ],
            ],
            [
                'id' => 3,
                'question' => 'What is the capital of Spain?',
                'answers' => [
                    [
                        'id' => 1,
                        'answer' => 'Paris',
                        'is_correct' => false
                    ],
                    [
                        'id' => 2,
                        'answer' => 'London',
                        'is_correct' => false
                    ],
                    [
                        'id' => 3,
                        'answer' => 'Berlin',
                        'is_correct' => false
                    ],
                    [
                        'id' => 4,
                        'answer' => 'Madrid',
                        'is_correct' => true
                    ],
                ],
            ],
            [
                'id' => 4,
                'question' => 'What is the capital of Italy?',
                'answers' => [
                    [
                        'id' => 1,
                        'answer' => 'Paris',
                        'is_correct' => false
                    ],
                    [
                        'id' => 2,
                        'answer' => 'London',
                        'is_correct' => false
                    ],
                    [
                        'id' => 3,
                        'answer' => 'Berlin',
                        'is_correct' => false
                    ],
                    [
                        'id' => 4,
                        'answer' => 'Rome',
                        'is_correct' => true
                    ]
                ],
            ],
            [
                'id' => 5,
                'question' => 'What is the capital of England?',
                'answers' => [
                    [ 
                        'id' => 1,
                        'answer' => 'Paris',
                        'is_correct' => false
                    ],
                    [ 
                        'id' => 2,
                        'answer' => 'London',
                        'is_correct' => true
                    ],
                    [ 
                        'id' => 3,
                        'answer' => 'Berlin',
                        'is_correct' => false
                    ],
                    [ 
                        'id' => 4,
                        'answer' => 'Madrid',
                        'is_correct' => false
                    ],
                ],
            ],
        ];
    }

}