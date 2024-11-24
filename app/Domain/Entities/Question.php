<?php

namespace App\Domain\Entities;

class Question
{
    private int $id;
    private Answer | null $userResponse;
    public function __construct(private readonly string $question, private readonly string $difficulty, private readonly array $answers, $id=0) 
    {
        $this->id = $id;
        $this->userResponse = new Answer('', false, -1);
    }

    /**
     * Get the id.
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Set the user response.
     * @return void
     */
    public function setUserReponse(Answer $userResponse): void
    {
        $this->userResponse = true;
    }

    /**
     * Get the user response.
     * @return bool
     */
    public function isUserReponseCorrect(): bool
    {
        return $this->userResponse->isCorrect();
    }

    /**
     * Get the difficulty of the question
     * @return string
     */
    public function getDifficulty(): string
    {
        return $this->difficulty;
    }

    /**
     * Get the question.
     * @return string
     */
    public function getQuestion(): string
    {
        return $this->question;
    }

    /**
     * Get the answers.
     * @return array
     */
    public function getAnswers(): array
    {
        return $this->answers;
    }

    /**
     * Get the question as an array.
     * @return array
     */
    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'question' => $this->question,
            'difficulty' => $this->difficulty,
            'userResponse' => $this->userResponse->toArray(),
            'answers' => array_map(fn($answer) => $answer->toArray(), $this->answers)
        ];
    }
}
