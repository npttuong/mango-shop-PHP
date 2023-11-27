<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Illustration extends Model
{
    use HasFactory;

    protected $table = 'illustrations';

    protected $primaryKey = 'illustration_path';

    public $timestamps = false;

    public $autoincrement = false;

    protected $keyType = 'string';

    protected $fillable = [
        'illustration_path',
        'product_id'
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}