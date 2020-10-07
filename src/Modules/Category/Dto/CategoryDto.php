<?php

namespace App\Modules\Category\Dto;

use Symfony\Component\Validator\Constraints as Assert;

class CategoryDto
{
    private int $id;

    /**
     * @Assert\Length(
     *      min = 3,
     *      max = 255,
     *      minMessage = "Your name must be at least {{ limit }} characters long",
     *      maxMessage = "Your name cannot be longer than {{ limit }} characters",
     *      allowEmptyString = false
     * )
     */
    private string $name;

    private \DateTimeImmutable $createdAt;

    private \DateTimeImmutable $updatedAt;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getCreatedAt(): \DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): \DateTimeImmutable
    {
        return $this->updatedAt;
    }

}
