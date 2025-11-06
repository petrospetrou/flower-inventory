<?php

namespace App\Http\Controllers;

use App\Http\Requests\FlowerRequest;
use App\Models\Category;
use App\Services\Contracts\FlowerServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FlowerController extends Controller
{
    public function __construct(private FlowerServiceInterface $flowers) {}

    public function index(Request $request)
    {
        $filters = [
            'q'           => $request->get('q'),
            'category_id' => $request->get('category_id'),
        ];
        $sort = $request->get('sort', 'name');
        $dir  = $request->get('dir', 'asc');

        $items = $this->flowers->list($filters, $sort, $dir, 10);
        $categories = Category::orderBy('name')->get();

        return view('flowers.index', compact('items', 'categories'));
    }

    public function create()
    {
        $categories = Category::orderBy('name')->get();
        return view('flowers.create', compact('categories'));
    }

    public function store(FlowerRequest $request)
    {
        $data = $request->validated();

        // Save uploaded image (if any) to public disk
        if ($request->hasFile('image')) {
            $data['image_path'] = $request->file('image')->store('flowers', 'public');
        }

        $this->flowers->create($data);
        return redirect()->route('flowers.index')->with('ok', 'Flower created');
    }

    public function show(int $id)
    {
        $flower = $this->flowers->find($id);
        return view('flowers.show', compact('flower'));
    }

    public function edit(int $id)
    {
        $flower = $this->flowers->find($id);
        $categories = Category::orderBy('name')->get();
        return view('flowers.edit', compact('flower', 'categories'));
    }

    public function update(FlowerRequest $request, int $id)
    {
        $data = $request->validated();

        // Load current to manage existing file state
        $current = $this->flowers->find($id);

        // If user ticked "Remove current image"
        if ($request->boolean('remove_image') && $current->image_path) {
            Storage::disk('public')->delete($current->image_path);
            $data['image_path'] = null; // persist NULL to DB
        }

        // If a new image was uploaded, replace the old one
        if ($request->hasFile('image')) {
            if ($current->image_path) {
                Storage::disk('public')->delete($current->image_path);
            }
            $data['image_path'] = $request->file('image')->store('flowers', 'public');
        }

        $this->flowers->update($id, $data);
        return redirect()->route('flowers.index')->with('ok', 'Flower updated');
    }

    public function destroy(int $id)
    {
        // Clean up file on disk (if any) before deleting the record
        $current = $this->flowers->find($id);
        if ($current->image_path) {
            Storage::disk('public')->delete($current->image_path);
        }

        $this->flowers->delete($id);
        return redirect()->route('flowers.index')->with('ok', 'Flower deleted');
    }

    public function confirmDestroy(int $id)
    {
        $flower = $this->flowers->find($id);
        return view('flowers.delete', compact('flower'));
    }
}
