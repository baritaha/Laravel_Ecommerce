<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;

class Item extends Model
{
    protected $fillable = ['name', 'description', 'price', 'quantity', 'color', 'image', 'category_id','user_id'];
    public function category()
    {
        return $this->belongsTo(Category::class); // One item belongs to one category
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
  
}
