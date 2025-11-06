<?php

namespace App\Services;

use App\Models\Category;
use App\Services\Contracts\CategoryServiceInterface;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class CategoryService implements CategoryServiceInterface
{
    /**
     * List categories with optional filters and sorting.
     */
    public function list(array $filters = [], ?string $sort = 'name', ?string $dir = 'asc', int $perPage = 10)
    {
        $q = Category::query();

        // Basic search by name
        if (!empty($filters['q'])) {
            $q->where('name', 'like', '%' . $filters['q'] . '%');
        }

        if ($sort) {
            $q->orderBy($sort, $dir === 'desc' ? 'desc' : 'asc');
        }

        return $q->paginate($perPage);
    }

    /**
     * Find a category by ID.
     */
    public function find(int $id)
    {
        return Category::findOrFail($id);
    }

    /**
     * Create a new category.
     */
    public function create(array $data)
    {
        $category = Category::create([
            'name' => $data['name'],
        ]);

        Log::info('Category created', ['id' => $category->id]);

        return $category;
    }

    /**
     * Update an existing category.
     */
    public function update(int $id, array $data)
    {
        $category = Category::findOrFail($id);

        $category->update([
            'name' => $data['name'] ?? $category->name,
        ]);

        Log::info('Category updated', ['id' => $category->id]);

        return $category->fresh();
    }

    /**
     * Delete a category.
     */
    public function delete(int $id)
    {
        $category = Category::findOrFail($id);

        $deleted = $category->delete();

        Log::info('Category deleted', ['id' => $id]);

        return $deleted;
    }
}
