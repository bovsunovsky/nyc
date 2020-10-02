<?php
declare(strict_types=1);

namespace App\Modules\Manufacture\Service;

use App\Modules\Manufacture\Dto\ManufactureDto;

interface ManufactureProviderInterface
{
    public function getList();

    public function create(ManufactureDto $dto): void;

    public function update(ManufactureDto $dto, int $id): void;

    public function getById(int $id): ManufactureDto;

    public function delete($id): void;
}
