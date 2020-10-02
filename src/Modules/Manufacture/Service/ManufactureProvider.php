<?php

namespace App\Modules\Manufacture\Service;

use App\Modules\Manufacture\Dto\ManufactureDto;
use App\Modules\Manufacture\Entity\Manufacture;
use App\Modules\Manufacture\Repository\ManufactureRepository;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use Doctrine\ORM\EntityManagerInterface;

class ManufactureProvider implements ManufactureProviderInterface
{
    private ManufactureRepository $manufactureRepository;
    private EntityManagerInterface $em;

    public function __construct(ManufactureRepository $manufactureRepository, EntityManagerInterface $em)
    {
        $this->manufactureRepository = $manufactureRepository;
        $this->em = $em;
    }

    public function getList()
    {
        return $this->manufactureRepository->findAll();
    }

    public function create(ManufactureDto $dto): void
    {
        $manufacture = new Manufacture($dto);
        $manufacture->setCreatedAt(new \DateTimeImmutable());
        $manufacture->setUpdatedAt(new \DateTimeImmutable());
        try {
            $this->em->persist($manufacture);
            $this->em->flush();
        } catch (UniqueConstraintViolationException $e) {
        }
    }

    public function update(ManufactureDto $dto, int $id): void
    {
        $manufacture = $this->manufactureRepository->find($id);
        $manufacture->setName($dto->getName());
        $manufacture->setUpdatedAt(new \DateTimeImmutable());
        $this->em->flush();
    }

    public function getById(int $id): ManufactureDto
    {
        $manufacture = $this->manufactureRepository->find($id);

        return new ManufactureDto($manufacture->getName());
    }

    public function delete($id): void
    {
        $manufacture = $this->manufactureRepository->find($id);
        $this->em->remove($manufacture);
        $this->em->flush();
    }
}
