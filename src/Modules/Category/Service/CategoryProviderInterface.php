<?php

namespace App\Modules\Category\Service;

use App\Modules\Category\Dto\CategoryDto;

interface CategoryProviderInterface
{
    public function getList();

    public function create(CategoryDto $dto): void;

    public function update(CategoryDto $dto, int $id): void;

    public function findById(int $id): CategoryDto;

    public function delete($id): void;
}
