<?php
declare(strict_types=1);

namespace App\Tests\Modules\Manufacture\Dto;

use App\Modules\Manufacture\Dto\ManufactureDto;
use PHPUnit\Framework\TestCase;

class ManufactureDtoTest extends TestCase
{
    public function testCrete(): void
    {
        $manufactureDto = new ManufactureDto(
            $name = 'qwerty'
        );

        static::assertEquals($name, $manufactureDto->getName());
    }

}