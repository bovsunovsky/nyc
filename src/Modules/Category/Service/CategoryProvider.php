<?php

namespace App\Modules\Category\Service;

use App\Modules\Category\Dto\CategoryDto;
use App\Modules\Category\Entity\Category;
use App\Modules\Category\Repository\CategoryRepository;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use Doctrine\ORM\EntityManagerInterface;

class CategoryProvider implements CategoryProviderInterface
{
    private CategoryRepository $categoryRepository;
    private EntityManagerInterface $em;

    public function __construct(CategoryRepository $categoryRepository, EntityManagerInterface $em)
    {
        $this->categoryRepository = $categoryRepository;
        $this->em = $em;
    }

    /**
     * @return Category[]
     */
    public function getList()
    {
        return $this->categoryRepository->findAll();
    }

    public function create(CategoryDto $dto): void
    {
        $category = new Category($dto);
        $category->setCreatedAt(new \DateTimeImmutable());
        $category->setUpdatedAt($category->getCreatedAt());
        try {
            $this->em->persist($category);
            $this->em->flush();
        } catch (UniqueConstraintViolationException $e) {
        }
    }

    public function delete($id): void
    {
        $category = $this->categoryRepository->find($id);
        $this->em->remove($category);
        $this->em->flush();
    }

    public function update(CategoryDto $dto, int $id): void
    {
        $category = $this->categoryRepository->find($id);
        $category->setName($dto->getName());
        $category->setUpdatedAt(new \DateTimeImmutable());
        $this->em->flush();
    }

    public function findById(int $id): CategoryDto
    {
        $category = $this->categoryRepository->find($id);
        return  new CategoryDto($category->getName());
    }
}
