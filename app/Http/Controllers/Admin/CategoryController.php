<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $query = Category::withCount('products')->latest();

        // Search
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('is_active', $request->status === 'active');
        }

        // Sort by product count
        if ($request->filled('products_sort')) {
            $query->reorder()->orderBy('products_count', $request->products_sort);
        }

        $categories = $query->paginate(10)->withQueryString();

        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255|unique:categories,name',
            'description' => 'nullable|string',
            'image_type'  => 'required|in:file,url',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'image_url'   => 'nullable|url|max:2048',
        ]);

        $imagePath = $this->handleImage($request);

        Category::create([
            'name'        => $request->name,
            'slug'        => Str::slug($request->name),
            'description' => $request->description,
            'image'       => $imagePath,
            'is_active'   => $request->boolean('is_active', true),
        ]);

        return redirect()->route('admin.categories.index')
            ->with('success', 'Category created successfully!');
    }

    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name'        => 'required|string|max:255|unique:categories,name,' . $category->id,
            'description' => 'nullable|string',
            'image_type'  => 'required|in:file,url',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'image_url'   => 'nullable|url|max:2048',
        ]);

        $imagePath = $this->handleImage($request, $category->image);

        $category->update([
            'name'        => $request->name,
            'slug'        => Str::slug($request->name),
            'description' => $request->description,
            'image'       => $imagePath,
            'is_active'   => $request->boolean('is_active'),
        ]);

        return redirect()->route('admin.categories.index')
            ->with('success', 'Category updated successfully!');
    }

    public function destroy(Category $category)
    {
        if ($category->image && !Str::startsWith($category->image, 'http')) {
            Storage::disk('public')->delete($category->image);
        }

        $category->delete();

        return redirect()->route('admin.categories.index')
            ->with('success', 'Category deleted successfully!');
    }

    // ── Private Helper ────────────────────────────────────
    private function handleImage(Request $request, ?string $existing = null): ?string
    {
        if ($request->image_type === 'file' && $request->hasFile('image')) {
            if ($existing && !Str::startsWith($existing, 'http')) {
                Storage::disk('public')->delete($existing);
            }
            return $request->file('image')->store('categories', 'public');
        }

        if ($request->image_type === 'url' && $request->filled('image_url')) {
            if ($existing && !Str::startsWith($existing, 'http')) {
                Storage::disk('public')->delete($existing);
            }
            return $request->image_url;
        }

        return $existing;
    }
}
