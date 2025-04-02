<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Item;

class Category extends Model
{
    // Define fillable attributes for mass assignment
    protected $fillable = ['name'];
    public function items()
{
    return $this->hasMany(Item::class); // One category has many items
}

}
