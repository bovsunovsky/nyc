<?php
declare(strict_types=1);

namespace App\Tests\Modules\Category\Dto;

use App\Modules\Category\Dto\CategoryDto;
use PHPUnit\Framework\TestCase;

class CategoryDtoTest extends TestCase
{
    public function testCreate(): void
    {
        $testName = 'qwerty';
        $categoryDto = new CategoryDto($testName);

        static::assertEquals($testName, $categoryDto->getName());
    }
}