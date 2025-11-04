<?php

namespace App\Services\Contracts;

interface FlowerServiceInterface
{
    public function list(array $filters = [], ?string $sort = 'name', ?string $dir = 'asc', int $perPage = 10);
    public function find(int $id);
    public function create(array $data);
    public function update(int $id, array $data);
    public function delete(int $id);
}
