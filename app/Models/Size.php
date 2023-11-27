<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Size extends Model
{
    use HasFactory;
    protected $table = 'sizes';

    protected $primaryKey = 'size';

    public $timestamps = false;

    public $autoincrement = false;

    protected $keyType = 'string';

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'size_product', 'size', 'product_id')->withPivot('quantity');
    }

}