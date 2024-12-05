<?php 

namespace App\Domain\Entities;

class Answer 
{
    private int $id;
    public function __construct(private readonly string $answer, private readonly bool $isCorrect, $id = 0) 
    {
        $this->id = $id;
    }
    
    /**
     * Get the id.
     * 
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }
    
    /**
     * Get the answer.
     * 
     * @return string
     */
    public function getAnswer(): string
    {
        return $this->answer;
    }

    /**
     * Get the isCorrect.
     *
     * @return bool
     */
    public function isCorrect()
    {
        return $this->isCorrect;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'answer' => $this->answer,
            'isCorrect' => $this->isCorrect
        ];
    }
}