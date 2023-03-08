<?php

namespace Tests\Unit;

use App\Models\Category;
use App\Models\Todo;
use PHPUnit\Framework\TestCase;

class CategoryModelTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function category_has_todos(): void
    {
        $categories = Category::factory()
            ->has(Todo::factory(2))
            ->create();

        $this->assertTrue(
            $categories->todos()->exist()
        );
    }
}
