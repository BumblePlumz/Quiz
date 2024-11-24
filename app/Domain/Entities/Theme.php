<?php

namespace App\Domain\Entities;

class Theme 
{
    public function __construct(private readonly int $id, private readonly string $name) {}

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
     * Get the name.
     * 
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name
        ];
    }
}