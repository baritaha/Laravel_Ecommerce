<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class ItemController extends Controller
{
    /**
     * Apply the middleware.
     */
    public function __construct()
    {
        $this->middleware(['auth']); // Middleware to protect all routes for admins only
    }

    /**
     * Display a listing of the items.
     */
    public function index()
    {

        // Admins can view all users and their items
        $users = User::with('items')->get();
        $items = Item::with('category')->paginate(10); // Fetch items with pagination
        return view('items.index', compact('items', 'users'));
        //return view('items.index', compact('users'));
    }
    /**
     * Show the form for creating a new item.
     */
    public function create()
    {
        $categories = Category::all(); // Fetch all categories
        $users = User::all();
        return view('items.create', compact('categories', 'users')); // Pass categories to the view
    }
    /**
     * Store a newly created item.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'quantity' => 'required|numeric',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'color' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'user_id' => 'required|exists:users,id',
        ]);

        if ($request->hasFile('image')) {
            $filename = $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('images'), $filename);
            $validated['image'] = $filename;
        }
        // Associate the item with the authenticated admin
        // $validated['user_id'] = Auth::id();

        Item::create($validated);

        return redirect()->route('items.index')->with('success', 'Item created successfully');
    }

    /**
     * Display the specified item.
     */
    public function show($id)
    {
        $item = Item::with('category')->findOrFail($id);
        return view('items.show', compact('item'));
    }

    /**
     * Show the form for editing the specified item.
     */
    public function edit($id)
    {
        $item = Item::findOrFail($id); // Admins can edit any item
        $categories = Category::all(); // Fetch all categories
        return view('items.edit', compact('item', 'categories'));
    }

    /**
     * Update the specified item in storage.
     */
    public function update(Request $request, $id)
    {
        $item = Item::findOrFail($id); // Admins can update any item

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'quantity' => 'required|integer|min:1',
            'color' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $filename = $request->file('image')->getClientOriginalName();
            $path = $request->file('image')->move(public_path('images'), $filename);
            $validated['image'] = $filename;
        }

        $item->update($validated);

        return redirect()->route('items.index')->with('success', 'Item updated successfully');
    }

    /**
     * Remove the specified item from storage.
     */
    public function destroy($id)
    {
        $item = Item::findOrFail($id); // Admins can delete any item
        if ($item->image && Storage::exists('public/images/' . $item->image)) {
            Storage::delete('public/images/' . $item->image);
        }
        $item->delete();

        return redirect()->route('items.index')->with('success', 'Item deleted successfully');
    }
    // public function userItems()
    // {
    //     // Users can only see their own items
    //     $items = Item::where('user_id', Auth::id())->get();
    //     return view('items.userItems', compact('items'));
    // }
}
