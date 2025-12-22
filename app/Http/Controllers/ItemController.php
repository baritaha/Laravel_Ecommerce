<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ItemController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of items (ADMIN).
     * Supports filtering by category: /admin/items?category=ID
     */
    public function index(Request $request)
    {
        $query = Item::with('category');

        // 🔹 Filter by category (admin)
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        $items = $query->latest()->get();
        $categories = Category::all();

        return view('items.index', compact('items', 'categories'));
    }

    /**
     * Show the form for creating a new item (ADMIN).
     */
    public function create()
    {
        $categories = Category::all();

        return view('items.create', compact('categories'));
    }

    /**
     * Store a newly created item (ADMIN).
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'price'       => 'required|numeric',
            'quantity'    => 'required|integer|min:1',
            'description' => 'required|string',
            'color'       => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // 🔹 Assign creator
        $validated['user_id'] = Auth::id();

        // 🔹 Handle image upload
        if ($request->hasFile('image')) {
            $filename = time() . '_' . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('images/items'), $filename);
            $validated['image'] = $filename;
        }

        Item::create($validated);

        return redirect()
            ->route('items.index')
            ->with('success', 'Item created successfully.');
    }

    /**
     * Show the form for editing the specified item (ADMIN).
     */
    public function edit(Item $item)
    {
        // 🔒 Admin-only edit
        if (!Auth::user()->is_admin) {
            abort(403);
        }

        $categories = Category::all();

        return view('items.edit', compact('item', 'categories'));
    }

    /**
     * Update the specified item (ADMIN).
     */
    public function update(Request $request, Item $item)
    {
        // 🔒 Admin-only update
        if (!Auth::user()->is_admin) {
            abort(403);
        }

        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'price'       => 'required|numeric',
            'quantity'    => 'required|integer|min:1',
            'description' => 'nullable|string',
            'color'       => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // 🔹 Image replacement
        if ($request->hasFile('image')) {
            if ($item->image) {
                $oldPath = public_path('images/items/' . $item->image);
                if (file_exists($oldPath)) {
                    unlink($oldPath);
                }
            }

            $filename = time() . '_' . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('images/items'), $filename);
            $validated['image'] = $filename;
        }

        $item->update($validated);

        return redirect()
            ->route('items.index')
            ->with('success', 'Item updated successfully.');
    }

    /**
     * Remove the specified item (ADMIN).
     */
    public function destroy(Item $item)
    {
        // 🔒 Admin-only delete
        if (!Auth::user()->is_admin) {
            abort(403);
        }

        if ($item->image) {
            $path = public_path('images/items/' . $item->image);
            if (file_exists($path)) {
                unlink($path);
            }
        }

        $item->delete();

        return redirect()
            ->route('items.index')
            ->with('success', 'Item deleted successfully.');
    }

    /**
     * Shop page (USER).
     */
    public function shop()
    {
        $items = Item::where('quantity', '>', 0)
            ->latest()
            ->paginate(12);

        return view('shop.index', compact('items'));
    }
}
