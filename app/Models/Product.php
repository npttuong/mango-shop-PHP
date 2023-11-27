<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';

    public $timestamps = false;

    protected $fillable = [
        'product_name',
        'product_info',
        'product_description',
        'unit_price',
        'discount',
        'category_id',
        'product_short_des',
    ];

    protected $attributes = [
        'discount' => 0,
    ];

    public function sizes(): BelongsToMany
    {
        return $this->belongsToMany(Size::class, 'size_product', 'product_id', 'size')->withPivot('quantity');
    }

    public function colors(): BelongsToMany
    {
        return $this->belongsToMany(Color::class, 'color_product', 'product_id', 'color_code')->withPivot('quantity');
    }

    public function illustrations(): HasMany
    {
        return $this->hasMany(Illustration::class, 'product_id', 'id');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
}