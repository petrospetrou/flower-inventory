<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Services\Contracts\CategoryServiceInterface;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CategoryServiceTest extends TestCase
{
    use RefreshDatabase;

    // Test that a category can be created, stored, and retrieved successfully
    public function test_can_create_and_find_category(): void
    {
        /** @var CategoryServiceInterface $svc */
        $svc = app(CategoryServiceInterface::class);

        $category = $svc->create(['name' => 'Roses']);

        $this->assertDatabaseHas('categories', ['id' => $category->id, 'name' => 'Roses']);

        $found = $svc->find($category->id);
        $this->assertEquals('Roses', $found->name);
    }

    // Test that a category can be updated and deleted correctly
    public function test_can_update_and_delete_category(): void
    {
        $category = Category::factory()->create(['name' => 'OldName']);

        /** @var CategoryServiceInterface $svc */
        $svc = app(CategoryServiceInterface::class);

        $svc->update($category->id, ['name' => 'NewName']);
        $this->assertDatabaseHas('categories', ['id' => $category->id, 'name' => 'NewName']);

        $svc->delete($category->id);
        $this->assertDatabaseMissing('categories', ['id' => $category->id]);
    }
}
