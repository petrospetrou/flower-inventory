<?php

namespace App\Services;

use App\Models\Flower;
use App\Services\Contracts\FlowerServiceInterface;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class FlowerService implements FlowerServiceInterface
{
    /**
     * List flowers with optional filters, search, and sorting.
     */
    public function list(array $filters = [], ?string $sort = 'name', ?string $dir = 'asc', int $perPage = 10)
    {
        $q = Flower::query()->with('category');

        // Search by name or type
        if (!empty($filters['q'])) {
            $term = '%' . $filters['q'] . '%';
            $q->where(function ($w) use ($term) {
                $w->where('name', 'like', $term)
                  ->orWhere('type', 'like', $term);
            });
        }

        // Filter by category
        if (!empty($filters['category_id'])) {
            $q->where('category_id', $filters['category_id']);
        }

        // Sorting
        if ($sort) {
            $q->orderBy($sort, $dir === 'desc' ? 'desc' : 'asc');
        } else {
            $q->orderBy('name', 'asc');
        }

        return $q->paginate($perPage);
    }

    /**
     * Find a flower by ID.
     */
    public function find(int $id)
    {
        return Flower::with('category')->findOrFail($id);
    }

    /**
     * Create a new flower.
     */
    public function create(array $data)
    {
        $flower = Flower::create([
            'category_id' => $data['category_id'],
            'name'        => $data['name'],
            'type'        => $data['type'] ?? null,
            'price'       => $data['price'],
            'description' => $data['description'] ?? null,
            'image_path'  => $data['image_path'] ?? null,
        ]);

        Log::info('Flower created', ['id' => $flower->id]);

        return $flower->load('category');
    }

    /**
     * Update an existing flower.
     */
    public function update(int $id, array $data)
    {
        $flower = Flower::findOrFail($id);

        $flower->update([
            'category_id' => $data['category_id'] ?? $flower->category_id,
            'name'        => $data['name'] ?? $flower->name,
            'type'        => $data['type'] ?? $flower->type,
            'price'       => $data['price'] ?? $flower->price,
            'description' => $data['description'] ?? $flower->description,
            'image_path'  => $data['image_path'] ?? $flower->image_path,
        ]);

        Log::info('Flower updated', ['id' => $flower->id]);

        return $flower->fresh('category');
    }

    /**
     * Delete a flower.
     */
    public function delete(int $id)
    {
        $flower = Flower::findOrFail($id);

        $deleted = $flower->delete();

        Log::info('Flower deleted', ['id' => $id]);

        return $deleted;
    }
}
