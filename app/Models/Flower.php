<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Flower extends Model {
    protected $fillable = ['category_id','name','type','price','description','image_path'];
    
    // Define relationship: A flower belongs to one category
    public function category() { return $this->belongsTo(Category::class); }
}

