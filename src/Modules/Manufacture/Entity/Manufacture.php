<?php

declare(strict_types=1);

namespace App\Modules\Manufacture\Entity;

use App\Modules\Manufacture\Dto\ManufactureDto;
use App\Modules\Manufacture\Repository\ManufactureRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ManufactureRepository::class)
 */
class Manufacture
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $name;
    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private \DateTimeImmutable $createdAt;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private \DateTimeImmutable $updatedAt;

    public function __construct(ManufactureDto $dto)
    {
        $this->name = $dto->getName();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): Manufacture
    {
        $this->id = $id;

        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): Manufacture
    {
        $this->name = $name;

        return $this;
    }

    public function getCreatedAt(): \DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): Manufacture
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): \DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeImmutable $updatedAt): Manufacture
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }
}
