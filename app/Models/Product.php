<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    /**
     * 
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'category_id',
        'name',
        'description',
        'price',
        'quantity',
        'image', 
    ];

    
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function comments()
    {
    return $this->hasMany(Comment::class);
    }
    public function wishedBy()
{
    return $this->belongsToMany(User::class, 'wishlists');
}
}
