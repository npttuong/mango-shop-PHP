<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Color extends Model
{
    use HasFactory;

    protected $table = 'colors';

    protected $primaryKey = 'color_code';

    public $timestamps = false;

    public $autoincrement = false;
    protected $keyType = 'string';

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'color_product', 'color_code', 'product_id')->withPivot('quantity');
    }

}