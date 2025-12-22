<?php

namespace Database\Seeders;

use App\Models\Item;
use App\Models\User;
use App\Models\Category;
use Illuminate\Database\Seeder;

class ItemSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::where('is_admin', false)->get();
        $categories = Category::all();

        foreach ($categories as $category) {
            foreach ($users as $user) {
                Item::create([
                    'name'        => $category->name . ' Item',
                    'description' => 'Sample item for ' . $category->name,
                    'price'       => rand(10, 500),
                    'quantity'    => rand(1, 50),   // ✅ REQUIRED
                    'color'       => null,          // optional
                    'image'       => null,          // optional
                    'category_id' => $category->id,
                    'user_id'     => $user->id,
                ]);
            }
        }
    }
}
