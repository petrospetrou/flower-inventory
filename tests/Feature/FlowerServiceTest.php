<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Services\Contracts\FlowerServiceInterface;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FlowerServiceTest extends TestCase
{
    use RefreshDatabase;

    // Test that a flower can be created and stored correctly in the database
    public function test_can_create_flower(): void
    {
        $category = Category::factory()->create(['name' => 'Tulips']);

        /** @var FlowerServiceInterface $svc */
        $svc = app(FlowerServiceInterface::class);

        $flower = $svc->create([
            'category_id' => $category->id,
            'name' => 'Yellow Tulip',
            'type' => 'Single Early',
            'price' => 2.5,
        ]);

        $this->assertDatabaseHas('flowers', [
            'id' => $flower->id,
            'name' => 'Yellow Tulip',
        ]);
    }
}
